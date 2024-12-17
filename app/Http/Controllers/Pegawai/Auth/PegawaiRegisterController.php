<?php

namespace App\Http\Controllers\Pegawai\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class PegawaiRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $validate = Validator::make(
            $data,
            [
                'nama_pegawai' => ['required'],
                'nip' => ['required'],
                'alamat' => ['required'],
                'jenis_kelamin' => ['required'],
                'telpon' => ['required'],
                'jabatan' => ['required'],
                'divisi' => ['required'],
                'hak_akses' => ['required'],
                'username' => ['required', 'string', 'username'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],

            ],
            [
                'nama_pegawai.required' => 'Nama anda wajib diisi!',
                'nip.required' => 'NIP anda wajib diisi!',
                'alamat.required' => 'Alamat anda wajib diisi!',
                'jenis_kelamin.required' => 'Jenis Kelamin anda wajib diisi!',
                'telpon.required' => 'No Telp/WA anda wajib diisi!',
                'jabatan.required' => 'Jabatan anda wajib diisi!',
                'divisi.required' => 'Divisi anda wajib diisi!',
                'hak_akses.required' => 'Hak_akses anda wajib diisi!',
                'username.required' => 'Username anda wajib diisi!',
                'password.required' => 'Password anda wajib diisi!',
            ]
        );

        $pegawai = Pegawai::create([
            'nama_pegawai' => $data['nama_pegawai'],
            'nip' => $data['nip'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'telpon' => $data['telpon'],
            'jabatan' => $data['jabatan'],
            'divisi' => $data['divisi'],
            'hak_akses' => $data['hak_akses'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($pegawai));

        Auth::guard('pegawai')->login($pegawai);

        return redirect(route('dashboard', false));
    }

    public function edit($id_pegawai)
    {
        $pegawai = Pegawai::where('id_pegawai', $id_pegawai)->first();

        return view('dashboard.pegawai.edit', ['pegawai' => $pegawai]);

    }
    public function update(Request $request, $id_pegawai)
    {
        // Validate inputan
        $validate = Validator::make(
            $request->all(),
            [
                'nama_pegawai' => ['required'],
                'nip' => ['required'],
                'jenis_kelamin' => ['required'],
                'alamat' => ['required'],
                'telpon' => ['required'],
                'jabatan' => ['required'],
                'divisi' => ['required'],
                'hak_akses' => ['required'],
                'username' => ['required', 'string', 'unique:pegawai,username'],
                'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'nama_pegawai.required' => 'NAMA WAJIB DIISI !',
                'nip.required' => 'NIP WAJIB DIISI !',
                'alamat.required' => 'ALAMAT WAJIB DIISI !',
                'jenis_kelamin.required' => 'JENIS KELAMIN WAJIB DIISI !',
                'telpon.required' => 'NO TELP/WA WAJIB DIISI !',
                'jabatan.required' => 'JABATAN WAJIB DIISI !',
                'divisi.required' => 'DIVISI WAJIB DIISI !',
                'hak_akses.required' => 'HAK AKSES WAJIB DIISI !',
                'username.required' => 'USERNAME WAJIB DIISI !',
                'username.unique' => 'USERNAME TELAH TERPAKAI !',
                'password.nullable' => 'PASSWORD WAJIB DIISI !',    
                'password.confirmed' => 'PASSWORD TIDAK COCOK!',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // persiapan data update
        $data = [
            'nama_pegawai' => $request->nama_pegawai,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'telpon' => $request->telpon,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'hak_akses' => $request->hak_akses,
            'username' => $request->username,
        ];

        // Update password hanya jika yerverif
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        Pegawai::find($id_pegawai)->update($data);

        return redirect()->route('tampil.pegawai')->with('success', 'DATA PEGAWAI TELAH DIPERBARUI !');
    }

    public function destroy($id_pegawai)
    {
        $pegawai = Pegawai::find($id_pegawai);

        if (!$pegawai) {
            return redirect()->back()->with('error', 'DATA PEGAWAI TIDAK DAPAT DIHAPUS!');
        }

        $pegawai->delete();

        return redirect()->back()->with('success', 'DATA PEGAWAI TELAH DIHAPUS !');
    }


    public function tampil(): View
    {
        $pegawai = Pegawai::all();

        return view('dashboard.pegawai.index', compact('pegawai'));
    }

    public function tambah(Request $request): RedirectResponse
    {
        $data = $request->all();

        $validate = Validator::make(
            $data,
            [
                'nama_pegawai' => ['required'],
                'nip' => ['required'],
                'alamat' => ['required'],
                'jenis_kelamin' => ['required'],
                'telpon' => ['required'],
                'jabatan' => ['required'],
                'divisi' => ['required'],
                'hak_akses' => ['required'],
                // 'username' => ['required', 'string', 'username'],
                'username' => ['required', 'string', 'unique:pegawai,username'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'nama_pegawai.required' => 'NAMA WAJIB DIISI !',
                'nip.required' => 'NIP WAJIB DIISI !',
                'alamat.required' => 'ALAMAT WAJIB DIISI !',
                'jenis_kelamin.required' => 'JENIS KELAMIN WAJIB DIISI !',
                'telpon.required' => 'NO TELP/WA WAJIB DIISI !',
                'jabatan.required' => 'JABATAN WAJIB DIISI !',
                'divisi.required' => 'DIVISI WAJIB DIISI !',
                'hak_akses.required' => 'HAK AKSES WAJIB DIISI !',
                'username.required' => 'USERNAME WAJIB DIISI !',
                'username.unique' => 'USERNAME TELAH TERPAKAI !',
                'password.required' => 'PASSWORD WAJIB DIISI !',
            ]
        );

        if ($validate->fails()) {
            $errors = implode(', ', $validate->errors()->all());
            return redirect()->back()->with('error', 'DATA PEGAWAI GAGAL KARENA ' . $errors)->withInput();
        }

        $pegawai = Pegawai::create([
            'nama_pegawai' => $data['nama_pegawai'],
            'nip' => $data['nip'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'telpon' => $data['telpon'],
            'jabatan' => $data['jabatan'],
            'divisi' => $data['divisi'],
            'hak_akses' => $data['hak_akses'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->back()->with('success', 'DATA PEGAWAI TELAH DIPERBARUI !');

    }
}
