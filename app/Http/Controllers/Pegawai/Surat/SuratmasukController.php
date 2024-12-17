<?php

namespace App\Http\Controllers\Pegawai\Surat;

use App\Models\Suratmasuk;
use App\Models\Disposisi;
use App\Models\Arsip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratmasukController extends Controller
{
    public function index()
    {
        // Ambil ID pegawai yang sedang login
        $id_pegawai = Auth::id();

        // Ambil surat masuk yang sesuai dengan id_pegawai yang sedang login
        // Jika peran pengguna menentukan hak akses, Anda bisa menyesuaikan filter di sini
        $suratmasuk = SuratMasuk::where('id_pegawai', $id_pegawai)->get();

        return view('dashboard.surat.index', compact('suratmasuk'));
    }
    public function store(Request $request)
    {
        // Ambil semua data dari request
        $data = $request->all();

        // Validasi input
        $validate = Validator::make(
            $data,
            [
                'no_surat' => ['required', 'string', 'max:255'],
                'tgl_surat' => ['required', 'date'],
                'tujuan_dispo' => ['required', 'array'],
                'tujuan_dispo.*' => ['string'],
                'tgl_diterima' => ['required', 'date'],
                'asal_surat' => ['required', 'string', 'max:255'],
                'perihal' => ['nullable', 'string'],
                'perihal_file' => ['nullable', 'file', 'mimes:pdf,jpg,png,jpeg'],
            ],
            [
                'no_surat.required' => 'No Surat wajib diisi!',
                'tgl_surat.required' => 'Tanggal Surat wajib diisi!',
                'tujuan_dispo.required' => 'Tujuan disposisi wajib dipilih!',
                'tgl_diterima.required' => 'Tanggal Diterima wajib diisi!',
                'asal_surat.required' => 'Asal Surat wajib diisi!',
                'perihal.required' => 'Perihal wajib diisi!',
                'lampiran.mimes' => 'Lampiran harus berupa file PDF atau gambar (JPG, PNG, JPEG)',
            ]
        );

        // Jika validasi gagal, kembalikan dengan error
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Proses penyimpanan data SuratMasuk
        $suratMasuk = new SuratMasuk();
        $suratMasuk->no_surat = $data['no_surat'];
        $suratMasuk->tgl_surat = $data['tgl_surat'];
        $suratMasuk->tujuan_dispo = implode(', ', $data['tujuan_dispo']); // Menggabungkan tujuan disposisi yang dipilih
        $suratMasuk->tgl_diterima = $data['tgl_diterima'];
        $suratMasuk->asal_surat = $data['asal_surat'];
        $suratMasuk->perihal = $data['perihal'] ?? null;

        // Ambil ID pegawai yang sedang login dan set ke id_pegawai
        $suratMasuk->id_pegawai = Auth::user()->id_pegawai;

        // Proses upload file lampiran jika ada
        if ($request->hasFile('lampiran_file')) {
            $file = $request->file('lampiran_file');
            $path = $file->store('lampiran'); // Menyimpan file di storage/app/lampiran
            $suratMasuk->lampiran_file = $path; // Menyimpan path file di database
        }

        // Simpan data ke database
        $suratMasuk->save();

        // Simpan data ke tabel arsip
        $arsip = new Arsip();
        $arsip->tgl_arsip = now(); // Tanggal arsip otomatis saat ini
        $arsip->id_dispo = null; // Sesuaikan jika ada data yang relevan
        $arsip->id_sm = $suratMasuk->id_sm; // Menggunakan ID surat masuk yang baru saja disimpan
        $arsip->id_pegawai = $suratMasuk->id_pegawai; // ID pegawai yang sama
        $arsip->save();

        // Redirect ke halaman surat masuk dengan pesan sukses
        return redirect()->route('suratmasuk.index')->with('success', 'Data Surat Masuk berhasil disimpan dan diarsipkan!');
    }

    public function edit($id_sm)
    {
        
        $suratmasuk = Suratmasuk::where('id_sm', $id_sm)->first();

        return view('dashboard.surat.edit', ['suratmasuk' => $suratmasuk]);

    }

    public function show($id_sm)
    {

        // Mengambil data Suratmasuk berdasarkan ID
        $suratmasuk = Suratmasuk::where('id_sm', $id_sm)->first();

        // Mengambil disposisi yang berelasi dengan Suratmasuk
        $disposisi = $suratmasuk->disposisi;  // Menggunakan relasi yang telah didefinisikan

        // Mengirimkan data Suratmasuk dan Disposisi ke view
        return view('dashboard.surat.show', [
            'suratmasuk' => $suratmasuk,
            'disposisi' => $disposisi
        ]);


    }

    public function update(Request $request, $id_sm)
    {
        // Ambil semua data dari request
        $data = $request->all();

        // Validasi input
        $validate = Validator::make(
            $data,
            [
                'no_surat' => ['required', 'string', 'max:255'],
                'tgl_surat' => ['required', 'date'],
                'tujuan_dispo' => ['required', 'array'],
                'tujuan_dispo.*' => ['string'],
                'tgl_diterima' => ['required', 'date'],
                'asal_surat' => ['required', 'string', 'max:255'],
                'perihal' => ['nullable', 'string'],  // Perihal boleh kosong
                'lampiran' => ['nullable', 'file', 'mimes:pdf,jpg,png,jpeg'],  // Validasi file lampiran
            ],
            [
                'no_surat.required' => 'No Surat wajib diisi!',
                'tgl_surat.required' => 'Tanggal Surat wajib diisi!',
                'tujuan_dispo.required' => 'Tujuan disposisi wajib dipilih!',
                'tgl_diterima.required' => 'Tanggal Diterima wajib diisi!',
                'asal_surat.required' => 'Asal Surat wajib diisi!',
                'perihal.required' => 'Perihal wajib diisi!',
                'lampiran.mimes' => 'Lampiran harus berupa file PDF atau gambar (JPG, PNG, JPEG)',
            ]
        );

        // Jika validasi gagal, kembalikan dengan error
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Mencari data SuratMasuk berdasarkan ID yang diberikan
        $suratMasuk = SuratMasuk::find($id_sm);

        // Pastikan data ditemukan
        if (!$suratMasuk) {
            return redirect()->route('suratmasuk.index')->with('error', 'Data Surat Masuk tidak ditemukan!');
        }

        // Update data SuratMasuk dengan data yang ada di request
        $suratMasuk->update([
            'no_surat' => $data['no_surat'],
            'tgl_surat' => $data['tgl_surat'],
            'tujuan_dispo' => implode(', ', $data['tujuan_dispo']), // Menggabungkan tujuan disposisi yang dipilih
            'tgl_diterima' => $data['tgl_diterima'],
            'asal_surat' => $data['asal_surat'],
            'perihal' => $data['perihal'] ?? null, // Perihal bisa null
        ]);

        // Proses upload file lampiran jika ada
        if ($request->hasFile('lampiran')) {
            // Hapus file lama jika ada dan sudah ada file baru
            if ($suratMasuk->lampiran) {
                Storage::delete($suratMasuk->lampiran); // Menghapus file yang lama
            }

            // Mengunggah file baru
            $file = $request->file('lampiran');
            $path = $file->store('lampiran', 'public'); // Menyimpan file di storage/app/lampiran
            $suratMasuk->lampiran = $path; // Menyimpan path file di database
        }

        // Simpan perubahan setelah file di-upload
        $suratMasuk->save();

        // Redirect ke halaman surat masuk dengan pesan sukses
        return redirect()->route('suratmasuk.index')->with('success', 'Data Surat Masuk berhasil diperbarui!');
    }




    public function destroy($id_sm)
    {
        $suratmasuk = Suratmasuk::find($id_sm);

        if (!$suratmasuk) {
            return redirect()->back()->with('error', 'DATA SURAT TIDAK DAPAT DIHAPUS!');
        }

        $suratmasuk->delete();

        return redirect()->back()->with('success', 'DATA SURAT TELAH DIHAPUS !');
    }
}
