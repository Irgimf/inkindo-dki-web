<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:webp {--quality=88 : Kualitas WebP (1-100)} {--max-width=1920 : Lebar maksimal gambar}';
    protected $description = 'Konversi dan kompres seluruh gambar JPG/PNG di public/ menjadi WebP serta perbarui referensi di DB & kode';

    public function handle(): int
    {
        if (!function_exists('imagewebp')) {
            $this->error('Ekstensi PHP GD dengan dukungan imagewebp() tidak tersedia.');
            return self::FAILURE;
        }

        $quality = max(50, min(100, (int) $this->option('quality')));
        $maxWidth = max(640, (int) $this->option('max-width'));

        $folders = [
            public_path('assets'),
            public_path('mitra_logos'),
            public_path('cms_uploads'),
            base_path('../sim-inkindo-dki/public/mitra_logos'),
            base_path('../sim-inkindo-dki/public/cms_uploads'),
        ];

        $convertedCount = 0;
        $savedBytes = 0;

        foreach ($folders as $dir) {
            if (!is_dir($dir)) {
                continue;
            }

            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS)
            );

            foreach ($iterator as $file) {
                if (!$file->isFile()) {
                    continue;
                }

                $fullPath = $file->getPathname();
                $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
                    continue;
                }

                $origSize = filesize($fullPath) ?: 0;
                $webpPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $fullPath);
                if (!$webpPath) {
                    continue;
                }

                if ($this->convertFile($fullPath, $webpPath, $ext, $maxWidth, $quality)) {
                    $newSize = filesize($webpPath) ?: 0;
                    $savedBytes += max(0, $origSize - $newSize);
                    $convertedCount++;
                }
            }
        }

        $dbUpdated = $this->updateDatabaseReferences();
        $codeUpdated = $this->updateCodeReferences();

        $savedMb = number_format($savedBytes / 1048576, 2);
        $this->info("Selesai! {$convertedCount} gambar dikonversi ke WebP (hemat {$savedMb} MB).");
        $this->info("Referensi diperbarui: {$dbUpdated} baris database, {$codeUpdated} file kode.");

        return self::SUCCESS;
    }

    private function convertFile(string $src, string $dest, string $ext, int $maxWidth, int $quality): bool
    {
        $img = null;
        if ($ext === 'jpg' || $ext === 'jpeg') {
            $img = @imagecreatefromjpeg($src);
            if ($img && function_exists('exif_read_data')) {
                $exif = @exif_read_data($src);
                $orientation = (int) ($exif['Orientation'] ?? 1);
                if ($orientation === 3) {
                    $img = imagerotate($img, 180, 0);
                } elseif ($orientation === 6) {
                    $img = imagerotate($img, -90, 0);
                } elseif ($orientation === 8) {
                    $img = imagerotate($img, 90, 0);
                }
            }
        } elseif ($ext === 'png') {
            $img = @imagecreatefrompng($src);
            if ($img) {
                if (function_exists('imagepalettetotruecolor')) {
                    @imagepalettetotruecolor($img);
                }
                imagealphablending($img, true);
                imagesavealpha($img, true);
            }
        }

        if (!$img) {
            return false;
        }

        $origW = imagesx($img);
        $origH = imagesy($img);
        if ($origW > $maxWidth && $origH > 0) {
            $newW = $maxWidth;
            $newH = (int) round(($origH / $origW) * $newW);
            $resized = imagecreatetruecolor($newW, $newH);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
            imagefilledrectangle($resized, 0, 0, $newW, $newH, $transparent);
            imagecopyresampled($resized, $img, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
            imagedestroy($img);
            $img = $resized;
        }

        $ok = @imagewebp($img, $dest, $quality);
        imagedestroy($img);

        if (!$ok || !is_file($dest) || filesize($dest) === 0) {
            @unlink($dest);
            return false;
        }

        @unlink($src);
        return true;
    }

    private function updateDatabaseReferences(): int
    {
        $targets = [
            'cms_berita'           => ['gambar'],
            'cms_hero_banners'     => ['gambar'],
            'cms_hero_backgrounds' => ['gambar'],
            'cms_page_backgrounds' => ['image_path', 'default_path'],
            'cms_tentang_profile'  => ['hero_image', 'sejarah_image', 'visimisi_bg_image'],
            'mitra_kerja'          => ['logo'],
            'mitra_products'       => ['gambar_produk'],
        ];

        $updated = 0;
        foreach ($targets as $table => $columns) {
            if (!Schema::hasTable($table)) {
                continue;
            }
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $changes = [];
                foreach ($columns as $col) {
                    if (!isset($row->$col) || !is_string($row->$col)) {
                        continue;
                    }
                    $val = $row->$col;
                    if (preg_match('/\.(jpe?g|png)$/i', $val)) {
                        $webpVal = preg_replace('/\.(jpe?g|png)$/i', '.webp', $val);
                        $rel = ltrim(str_replace('\\', '/', $webpVal), '/');
                        if (is_file(public_path($rel)) || is_file(base_path('../sim-inkindo-dki/public/' . $rel))) {
                            $changes[$col] = $webpVal;
                        }
                    }
                }
                if (!empty($changes)) {
                    DB::table($table)->where('id', $row->id)->update($changes);
                    $updated++;
                }
            }
        }

        return $updated;
    }

    private function updateCodeReferences(): int
    {
        $scanDirs = [
            resource_path('views'),
            public_path('css'),
            public_path('js'),
            app_path(),
        ];

        $updatedFiles = 0;
        foreach ($scanDirs as $dir) {
            if (!is_dir($dir)) {
                continue;
            }
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS)
            );
            foreach ($iterator as $file) {
                if (!$file->isFile()) {
                    continue;
                }
                $ext = strtolower($file->getExtension());
                if (!in_array($ext, ['php', 'css', 'js'], true)) {
                    continue;
                }
                $path = $file->getPathname();
                $content = file_get_contents($path);
                if ($content === false) {
                    continue;
                }

                $newContent = preg_replace_callback(
                    '/\b((?:assets|mitra_logos|cms_uploads)\/[A-Za-z0-9_\/\-.]+)\.(jpe?g|png)\b/i',
                    static function (array $m): string {
                        $candidate = $m[1] . '.webp';
                        if (is_file(public_path($candidate)) || is_file(base_path('../sim-inkindo-dki/public/' . $candidate))) {
                            return $candidate;
                        }
                        return $m[0];
                    },
                    $content
                );

                if ($newContent !== null && $newContent !== $content) {
                    file_put_contents($path, $newContent);
                    $updatedFiles++;
                }
            }
        }

        return $updatedFiles;
    }
}

