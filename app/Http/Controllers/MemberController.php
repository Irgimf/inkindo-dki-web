<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    /**
     * Return all members and summary statistics as JSON.
     */
    public function index()
    {
        $members = Member::orderBy('id', 'asc')->get();
        $total = $members->count();

        $besarCount = $members->where('kualifikasi', 'Besar')->count();
        $menengahCount = $members->where('kualifikasi', 'Menengah')->count();
        $kecilCount = $members->where('kualifikasi', 'Kecil')->count();

        $besarPct = $total > 0 ? round(($besarCount / $total) * 100) : 0;
        $menengahPct = $total > 0 ? round(($menengahCount / $total) * 100) : 0;
        $kecilPct = $total > 0 ? round(($kecilCount / $total) * 100) : 0;

        return response()->json([
            'success' => true,
            'is_admin' => Auth::check(),
            'stats' => [
                'total' => $total,
                'besar_count' => $besarCount,
                'menengah_count' => $menengahCount,
                'kecil_count' => $kecilCount,
                'besar_pct' => $besarPct,
                'menengah_pct' => $menengahPct,
                'kecil_pct' => $kecilPct,
            ],
            'members' => $members->map(fn (Member $m) => $m->toFrontendArray())->values(),
        ]);
    }

    /**
     * Store a newly created member in database.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Silakan login sebagai Admin Kesekretariatan terlebih dahulu.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npa' => ['required', 'string', 'max:100', 'unique:members,npa'],
            'status' => ['required', 'string', 'max:50'],
            'kualifikasi' => ['required', 'in:Besar,Menengah,Kecil'],
            'wilayah' => ['required', 'string', 'max:100'],
            'sbu' => ['required', 'string', 'max:150'],
            'alamat_domisili' => ['nullable', 'string'],
            'alamat_surat' => ['nullable', 'string'],
            'telepon' => ['nullable', 'string', 'max:100'],
            'fax' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'string', 'max:150'],
            'website' => ['nullable', 'string', 'max:255'],
            'sbu_items' => ['nullable', 'array'],
            'sbu_items.*.code' => ['required_with:sbu_items', 'string', 'max:255'],
            'sbu_items.*.kelas' => ['nullable', 'string', 'max:50'],
            'sbu_items.*.masaBerlaku' => ['nullable', 'string', 'max:50'],
            'sbu_items.*.subbidang' => ['nullable', 'array'],
        ], [
            'name.required' => 'Nama perusahaan wajib diisi.',
            'npa.required' => 'Nomor Anggota (NPA) wajib diisi.',
            'npa.unique' => 'Nomor Anggota (NPA) tersebut sudah terdaftar.',
        ]);

        $member = Member::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data anggota berhasil ditambahkan.',
            'member' => $member->toFrontendArray(),
        ], 201);
    }

    /**
     * Update the specified member in database.
     */
    public function update(Request $request, Member $member)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Silakan login sebagai Admin Kesekretariatan terlebih dahulu.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npa' => ['required', 'string', 'max:100', Rule::unique('members', 'npa')->ignore($member->id)],
            'status' => ['required', 'string', 'max:50'],
            'kualifikasi' => ['required', 'in:Besar,Menengah,Kecil'],
            'wilayah' => ['required', 'string', 'max:100'],
            'sbu' => ['required', 'string', 'max:150'],
            'alamat_domisili' => ['nullable', 'string'],
            'alamat_surat' => ['nullable', 'string'],
            'telepon' => ['nullable', 'string', 'max:100'],
            'fax' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'string', 'max:150'],
            'website' => ['nullable', 'string', 'max:255'],
            'sbu_items' => ['nullable', 'array'],
            'sbu_items.*.code' => ['required_with:sbu_items', 'string', 'max:255'],
            'sbu_items.*.kelas' => ['nullable', 'string', 'max:50'],
            'sbu_items.*.masaBerlaku' => ['nullable', 'string', 'max:50'],
            'sbu_items.*.subbidang' => ['nullable', 'array'],
        ], [
            'name.required' => 'Nama perusahaan wajib diisi.',
            'npa.required' => 'Nomor Anggota (NPA) wajib diisi.',
            'npa.unique' => 'Nomor Anggota (NPA) tersebut sudah digunakan anggota lain.',
        ]);

        $member->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data anggota berhasil diperbarui.',
            'member' => $member->toFrontendArray(),
        ]);
    }

    /**
     * Remove the specified member from database.
     */
    public function destroy(Member $member)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Silakan login sebagai Admin Kesekretariatan terlebih dahulu.',
            ], 403);
        }

        $member->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data anggota berhasil dihapus.',
        ]);
    }
}

