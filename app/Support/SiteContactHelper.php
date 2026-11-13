<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SiteContactHelper
{
    private static ?object $cache = null;

    public static function get(): object
    {
        if (self::$cache !== null) {
            return self::$cache;
        }

        $default = (object) [
            'bio'             => 'Ikatan Nasional Konsultan Indonesia (INKINDO) Provinsi DKI Jakarta merupakan wadah asosiasi perusahaan jasa konsultansi independen yang profesional dan berintegritas.',
            'alamat'          => 'Jl. Pertani No. 7, Duren Tiga - Pancoran, Jakarta Selatan 12760, DKI Jakarta',
            'telepon_1'       => '+62217942940',
            'telepon_2'       => '+6282112079750',
            'fax'             => '+62217942941',
            'email_1'         => 'sekretariat@inkindo-dki.org',
            'email_2'         => 'inkindo_dki@yahoo.com',
            'jam_operasional' => 'Senin - Jumat: 08.00 - 16.30 WIB',
            'youtube_url'     => 'https://www.youtube.com/@inkindodkiofficial',
            'facebook_url'    => 'https://www.facebook.com/inkindodki',
            'x_url'           => 'https://x.com/inkindoD',
            'instagram_url'   => 'https://www.instagram.com/inkindo_dki/',
            'copyright_text'  => '© 2026 DPP INKINDO DKI Jakarta. Hak Cipta Dilindungi.',
        ];

        try {
            if (Schema::hasTable('cms_footer_contact')) {
                $row = DB::table('cms_footer_contact')->orderBy('id')->first();
                if ($row) {
                    self::$cache = $row;
                    return self::$cache;
                }
            }
        } catch (\Throwable $e) {
            // Fallback ke data default jika DB belum siap
        }

        self::$cache = $default;
        return self::$cache;
    }
}

