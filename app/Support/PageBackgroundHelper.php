<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PageBackgroundHelper
{
    /** @var array<string, string>|null */
    private static ?array $cache = null;

    public static function get(string $key, string $default): string
    {
        if (self::$cache === null) {
            self::$cache = [];
            try {
                if (Schema::hasTable('cms_page_backgrounds')) {
                    $rows = DB::table('cms_page_backgrounds')
                        ->select('page_key', 'image_path')
                        ->get();
                    foreach ($rows as $row) {
                        if (! empty($row->page_key) && ! empty($row->image_path)) {
                            self::$cache[(string) $row->page_key] = (string) $row->image_path;
                        }
                    }
                }
            } catch (\Throwable $e) {
                // Fallback ke gambar default jika DB belum siap
            }
        }

        $val = trim(self::$cache[$key] ?? $default);
        if ($val === '') {
            $val = $default;
        }

        if (preg_match('#^(https?:)?//#i', $val)) {
            return $val;
        }

        return '/' . ltrim($val, '/');
    }
}

