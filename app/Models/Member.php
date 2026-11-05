<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'npa',
        'status',
        'kualifikasi',
        'wilayah',
        'sbu',
        'alamat_domisili',
        'alamat_surat',
        'telepon',
        'fax',
        'email',
        'website',
        'sbu_items',
    ];

    protected function casts(): array
    {
        return [
            'sbu_items' => 'array',
        ];
    }

    /**
     * Format for frontend JSON compatibility with existing JS structure.
     */
    public function toFrontendArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'npa' => $this->npa,
            'status' => $this->status,
            'kualifikasi' => $this->kualifikasi,
            'wilayah' => $this->wilayah,
            'sbu' => $this->sbu,
            'alamatDomisili' => $this->alamat_domisili ?: '-',
            'alamatSurat' => $this->alamat_surat ?: ($this->alamat_domisili ?: '-'),
            'telepon' => $this->telepon ?: '-',
            'fax' => $this->fax ?: '-',
            'email' => $this->email ?: '-',
            'website' => $this->website ?: '-',
            'sbuItems' => $this->sbu_items ?? [],
        ];
    }
}

