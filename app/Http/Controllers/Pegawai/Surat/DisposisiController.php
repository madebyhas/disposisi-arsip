<?php

namespace App\Http\Controllers\Pegawai\Surat;

use App\Models\Pegawai;
use App\Models\Disposisi;
use App\Models\Arsip;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Catatan_disposisi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DisposisiController extends Controller
{
    public function index()
    {
        $disposisi = Disposisi::all();

        return view('dashboard.disposisi.index', compact('disposisi'));
    }
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'no_agenda' => 'required|string|max:255',
            'sifat' => 'required|string',
            'keterangan' => 'required|string',
            'id_sm' => 'required|exists:suratmasuk,id_sm', // Validasi id_sm harus ada di tabel Suratmasuk
        ]);

        // Membuat Disposisi baru dengan data yang sudah tervalidasi
        $disposisi = new Disposisi();
        $disposisi->no_agenda = $request->no_agenda;
        $disposisi->sifat = $request->sifat;
        $disposisi->keterangan = $request->keterangan;
        $disposisi->id_sm = $request->id_sm; // Menambahkan relasi ke SuratMasuk

        // Simpan disposisi
        $disposisi->save();

        // Update id_dispo di tabel arsip berdasarkan id_sm
        $arsip = Arsip::where('id_sm', $request->id_sm)->first(); // Cari arsip dengan id_sm yang cocok
        if ($arsip) {
            $arsip->id_dispo = $disposisi->id_dispo; // Update id_dispo dengan ID disposisi yang baru dibuat
            $arsip->save(); // Simpan perubahan
        }

        // Redirect kembali ke halaman sebelumnya
        return back()->with('success', 'Disposisi berhasil disimpan dan arsip diperbarui!');
    }



    public function show($id_dispo)
    {
        $disposisi = Disposisi::with('catatan.pegawai')->findOrFail($id_dispo);

        return view('dashboard.disposisi.show', compact('disposisi'));
    }

    // Menampilkan form edit disposisi
    public function edit($id_dispo)
    {

        $disposisi = Disposisi::with('catatan.pegawai')->findOrFail($id_dispo);

        return view('dashboard.disposisi.edit', compact('disposisi'));
    }
    public function download($id_dispo)
    {
        // Ambil data disposisi beserta catatan dan pegawai
        $disposisi = Disposisi::with('catatan.pegawai')->findOrFail($id_dispo);

        // Generate PDF menggunakan view yang sudah ada
        $pdf = Pdf::loadView('dashboard.disposisi.lembar', compact('disposisi'));
        // Mendownload file PDF
        return $pdf->download('disposisi_lembar_' . $id_dispo . '.pdf');


    }
    public function getlembar($id_dispo)
    {
        // Ambil data disposisi beserta relasi catatan dan pegawai
        $disposisi = Disposisi::with('catatan.pegawai')->findOrFail($id_dispo);

        // Generate PDF menggunakan view yang sudah ada
        $pdf = Pdf::loadView('dashboard.disposisi.lembar', compact('disposisi'));

        // Untuk mendownload file PDF
        return $pdf->download('disposisi_lembar_' . $id_dispo . '.pdf');
    }

    public function destroy($id_dispo)
{
    // Cari data disposisi
    $disposisi = Disposisi::find($id_dispo);

    if (!$disposisi) {
        return redirect()->back()->with('error', 'DATA DISPOSISI TIDAK DAPAT DIHAPUS!');
    }

    // Lepaskan referensi di tabel arsip
    Arsip::where('id_dispo', $id_dispo)->update(['id_dispo' => null]);

    // Opsional: Hapus data disposisi jika masih ingin menghapus
    $disposisi->delete();

    return redirect()->back()->with('success', 'ID DISPOSISI DIHAPUS DARI TABEL ARSIP!');
}


}
