<?php

namespace App\Http\Controllers\Pegawai\Surat;

use App\Models\Arsip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ArsipController extends Controller
{
    public function index()
    {
        // Ambil semua data arsip dengan relasi
        // $arsip = Arsip::with(['suratmasuk', 'disposisi', 'pegawai'])->get();
        $arsip = Arsip::all();
    
        // Return view dengan data arsip

        return view('dashboard.arsip.index', compact('arsip'));
    }
    public function edit($id_arsip)
    {
        $arsip = Arsip::where('id_arsip', $id_arsip)->first();

        return view('dashboard.arsip.edit', ['arsip' => $arsip]);

    }

    public function update(Request $request, $id_arsip)
{
    // Ambil semua data dari request
    $data = $request->all();

    // Validasi input
    $validate = Validator::make(
        $data,
        [
            'tgl_arsip' => ['nullable', 'date'], // Tanggal Arsip (opsional)
        ],
        [
            'tgl_arsip.date' => 'Tanggal Arsip harus berupa tanggal yang valid!',
        ]
    );

    // Jika validasi gagal, kembalikan dengan error
    if ($validate->fails()) {
        return redirect()->back()->withErrors($validate)->withInput();
    }

    // Mencari data Arsip berdasarkan ID surat masuk
    $arsip = Arsip::where('id_arsip', $id_arsip)->first();

    // Pastikan data ditemukan
    if (!$arsip) {
        return redirect()->route('arsip.index')->with('error', 'Data Arsip tidak ditemukan!');
    }

    // Update data Arsip dengan data yang ada di request
    $arsip->update([
        'tgl_arsip' => $data['tgl_arsip'] ?? $arsip->tgl_arsip, // Update Tanggal Arsip jika diberikan
    ]);

    // Redirect ke halaman arsip dengan pesan sukses
    return redirect()->route('arsip.index')->with('success', 'Data Arsip berhasil diperbarui!');
}


    public function show($id_arsip)
    {

        // Mengambil data arsip berdasarkan ID
        $arsip = Arsip::where('id_arsip', $id_arsip)->first();

        // Mengirimkan data arsip dan Disposisi ke view
        return view('dashboard.arsip.show', [
            'arsip' => $arsip,
           
        ]);


    }
    public function destroy($id_arsip)
    {
        $arsip = Arsip::find($id_arsip);

        if (!$arsip) {
            return redirect()->back()->with('error', 'DATA ARSIP TIDAK DAPAT DIHAPUS!');
        }

        $arsip->delete();

        return redirect()->back()->with('success', 'DATA ARSIP TELAH DIHAPUS !');
    }

}
