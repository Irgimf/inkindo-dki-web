<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TranslateController extends Controller
{
    private function callGoogleTranslate(string $text): ?string
    {
        try {
            $response = Http::timeout(8)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ])
                ->get('https://translate.googleapis.com/translate_a/single', [
                    'client' => 'gtx',
                    'sl'     => 'id',
                    'tl'     => 'en',
                    'dt'     => 't',
                    'q'      => $text,
                ]);

            if (! $response->successful()) {
                return null;
            }

            $json = $response->json();
            if (! is_array($json) || empty($json[0]) || ! is_array($json[0])) {
                return null;
            }

            $out = '';
            foreach ($json[0] as $segment) {
                if (is_array($segment) && isset($segment[0])) {
                    $out .= (string) $segment[0];
                }
            }

            return $out !== '' ? $out : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function translateBatch(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'texts'   => ['required', 'array', 'max:60'],
            'texts.*' => ['required', 'string', 'max:4000'],
        ]);

        $texts = array_values(array_unique($validated['texts']));
        $translations = [];
        $uncached = [];

        foreach ($texts as $text) {
            $cacheKey = 'i18n_id_en_' . md5($text);
            $cached = Cache::get($cacheKey);
            if (is_string($cached) && $cached !== '') {
                $translations[$text] = $cached;
            } else {
                $uncached[] = $text;
            }
        }

        if (! empty($uncached)) {
            $separator = "\n[[[INKINDO_SEP_987]]]\n";
            $chunks = [];
            $currentChunk = [];
            $currentLen = 0;

            foreach ($uncached as $item) {
                $itemLen = mb_strlen($item);
                if (! empty($currentChunk) && ($currentLen + $itemLen > 2800 || count($currentChunk) >= 15)) {
                    $chunks[] = $currentChunk;
                    $currentChunk = [];
                    $currentLen = 0;
                }
                $currentChunk[] = $item;
                $currentLen += $itemLen + 26;
            }
            if (! empty($currentChunk)) {
                $chunks[] = $currentChunk;
            }

            foreach ($chunks as $chunk) {
                if (count($chunk) === 1) {
                    $single = $chunk[0];
                    $res = $this->callGoogleTranslate($single);
                    if ($res !== null) {
                        $translations[$single] = $res;
                        Cache::forever('i18n_id_en_' . md5($single), $res);
                    }
                    continue;
                }

                $joined = implode($separator, $chunk);
                $batchResult = $this->callGoogleTranslate($joined);

                if ($batchResult !== null) {
                    $parts = preg_split('/\s*\[\[\[INKINDO_SEP_987\]\]\]\s*/u', $batchResult);
                    if (is_array($parts) && count($parts) === count($chunk)) {
                        foreach ($chunk as $idx => $origText) {
                            $tr = trim((string) $parts[$idx]);
                            if ($tr !== '') {
                                $translations[$origText] = $tr;
                                Cache::forever('i18n_id_en_' . md5($origText), $tr);
                            }
                        }
                        continue;
                    }
                }

                // Fallback per item jika pemisah batch tidak cocok jumlahnya
                foreach ($chunk as $origText) {
                    $res = $this->callGoogleTranslate($origText);
                    if ($res !== null) {
                        $translations[$origText] = $res;
                        Cache::forever('i18n_id_en_' . md5($origText), $res);
                    }
                }
            }
        }

        return response()->json([
            'translations' => $translations,
        ]);
    }
}

