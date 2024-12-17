<?php

namespace App\Http\Controllers\Pegawai\Surat;

use Illuminate\Http\Request;
use App\Models\Catatan_disposisi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CatatanDisposisiController extends Controller
{
    // tambah catatan
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'catatan' => 'required|string|max:255',
            'id_dispo' => 'required|exists:disposisi,id_dispo',
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
        ]);

        // Simpan catatan baru
        $catatan = new Catatan_Disposisi();
        $catatan->catatan = $request->input('catatan');
        $catatan->id_dispo = $request->input('id_dispo');  // Ambil id_dispo dari form
        $catatan->id_pegawai = $request->input('id_pegawai');
        $catatan->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->back()->with('success', 'Catatan Disposisi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // Ambil semua data dari request
        $data = $request->all();

        // Validasi input
        $validate = Validator::make(
            $data,
            [
                'catatan' => 'required|string|max:255',
                'id_dispo' => 'required|exists:disposisi,id_dispo',
                'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            ]
        );


        // Jika validasi gagal, kembalikan dengan error
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        // Find the Catatan_Disposisi record to update
        $catatan = Catatan_disposisi::find($id);

        // Check if the record exists
        if (!$catatan) {
            return redirect()->back()->with('error', 'Catatan Disposisi tidak ditemukan');
        }

        $catatan->update([
            'catatan' => $data['catatan'],
            'id_pegawai' => $data['id_pegawai'],
            'id_dispo' => $data['id_dispo'],
        ]);
        $catatan->save();


        // // Redirect or response after updating
        return redirect()->back()->with('success', 'Catatan Disposisi berhasil diperbarui');
    }

}
