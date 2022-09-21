<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\DosenMaster;
use App\Models\TendikMaster;
use App\Models\UnitMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function request_login(Request $request)
    {
        $login = $request->validate([
            'nomor' => 'required',
            'password' => 'required'

        ]);

        $data = User::where('nomor', $request->nomor)->first();
        if ($data->is_aktif == '1') {
            if (Auth::attempt($login)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboar');
            }
        }
        $message = [
            'alert-type' => 'error',
            'message' => 'Gagal Login, Periksa Kombinasi Akun atau Aktivasi Akun.'
        ];

        return back()->with($message);
    }

    public function register()
    {
        $UnitMasters = UnitMaster::orderby('unit_kategori_id', 'ASC')->get();
        $Fakultast = UnitMaster::where('unit_kategori_id', 2)->get();
        $Prodis = UnitMaster::where('unit_kategori_id', 3)->orderby('unit_pengelola_id', 'ASC')->get();
        return view('auth.register', compact('UnitMasters', 'Fakultast', 'Prodis'));
    }

    public function request_register(Request $request)
    {
        $request->validate([
            'user_kategori' => 'required',
            'nomor' => 'required|unique:users,nomor',
            'nama' => 'required',
            'gender' => 'required',
            'hp' => 'nullable',
            'email' => 'email|required|unique:users,email',
            'alamat' => 'nullable',
            'jabfung' => 'nullable',
            'golongan' => 'nullable',
            'unit_master_id' => 'required',
            'fakultas_id' => 'nullable',
            'prodi_id' => 'nullable',
            'password' => 'min:8|required',
            'konfirmasi_password' => 'same:password'
        ]);

        DB::beginTransaction();
        if ($request->user_kategori == 1) {
            $validasi = DosenMaster::where('nomor', $request->nomor)->first();
            if ($validasi == null) {
                $dosen = new DosenMaster();
                $dosen->user_kategori = $request->user_kategori;
                $dosen->nomor = $request->nomor;
                $dosen->nama = $request->nama;
                $dosen->gender = $request->gender;
                $dosen->hp = $request->hp;
                $dosen->email = $request->email;
                $dosen->alamat = $request->alamat;
                $dosen->jabfung = $request->jabfung;
                $dosen->golongan = $request->golongan;
                $dosen->unit_master_id = $request->unit_master_id;
                $dosen->fakultas_id = $request->fakultas_id;
                $dosen->prodi_id = $request->prodi_id;
                $dosen->password = Hash::make($request->password);
                $dosen->save();

                $user = new User();
                $user->user_id = $dosen->id;
                $user->nama = $request->nama;
                $user->nomor = $request->nomor;
                $user->user_kategori = $request->user_kategori;
                $user->unit_master_id = $request->unit_master_id;
                $user->role = '0';
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->is_aktif = '0';
                $user->save();

                DB::commit();
            } elseif ($validasi != null) {
                $dosen = DosenMaster::where('nomor', $request->nomor)->first();

                $dosen->user_kategori = $request->user_kategori;
                $dosen->nama = $request->nama;
                $dosen->gender = $request->gender;
                $dosen->hp = $request->hp;
                $dosen->email = $request->email;
                $dosen->alamat = $request->alamat;
                $dosen->jabfung = $request->jabfung;
                $dosen->golongan = $request->golongan;
                $dosen->unit_master_id = $request->unit_master_id;
                $dosen->fakultas_id = $request->fakultas_id;
                $dosen->prodi_id = $request->prodi_id;
                $dosen->password = Hash::make($request->password);
                $dosen->save();

                $user = new User();
                $user->user_id = $dosen->id;
                $user->nama = $request->nama;
                $user->nomor = $request->nomor;
                $user->user_kategori = $request->user_kategori;
                $user->unit_master_id = $request->unit_master_id;
                $user->role = '0';
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->is_aktif = '0';
                $user->save();

                DB::commit();
            }
        } elseif ($request->user_kategori == 2) {
            $validasi = TendikMaster::where('nomor', $request->nomor)->first();
            if ($validasi == null) {
                $tendik = new TendikMaster();
                $tendik->user_kategori = $request->user_kategori;
                $tendik->nomor = $request->nomor;
                $tendik->nama = $request->nama;
                $tendik->gender = $request->gender;
                $tendik->hp = $request->hp;
                $tendik->email = $request->email;
                $tendik->alamat = $request->alamat;
                $tendik->unit_master_id = $request->unit_master_id;
                $tendik->fakultas_id = $request->fakultas_id;
                $tendik->prodi_id = $request->prodi_id;
                $tendik->password = Hash::make($request->password);
                $tendik->save();

                $user = new User();
                $user->user_id = $tendik->id;
                $user->nama = $request->nama;
                $user->nomor = $request->nomor;
                $user->user_kategori = $request->user_kategori;
                $user->unit_master_id = $request->unit_master_id;
                $user->role = '0';
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->is_aktif = '0';
                $user->save();

                DB::commit();
            } elseif ($validasi != null) {
                $tendik = TendikMaster::where('nomor', $request->nomor)->first();
                $tendik->user_kategori = $request->user_kategori;
                $tendik->nama = $request->nama;
                $tendik->gender = $request->gender;
                $tendik->hp = $request->hp;
                $tendik->email = $request->email;
                $tendik->alamat = $request->alamat;
                $tendik->unit_master_id = $request->unit_master_id;
                $tendik->fakultas_id = $request->fakultas_id;
                $tendik->prodi_id = $request->prodi_id;
                $tendik->password = Hash::make($request->password);
                $tendik->save();

                $user = new User();
                $user->user_id = $tendik->id;
                $user->nama = $request->nama;
                $user->nomor = $request->nomor;
                $user->user_kategori = $request->user_kategori;
                $user->unit_master_id = $request->unit_master_id;
                $user->role = '0';
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->is_aktif = '0';
                $user->save();

                DB::commit();
            }
        }

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan. Anda dapat login dengan Nomor Induk dan password anda'
        ];

        return redirect()->route('login')->with($message);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $message = [
            'alert-type' => 'success',
            'message' => 'Logout System'
        ];

        return redirect('/')->with($message);
    }

    public function profile()
    {
        $UnitMasters = UnitMaster::orderby('unit_kategori_id', 'ASC')->get();
        $Fakultast = UnitMaster::where('unit_kategori_id', 2)->get();
        $Prodis = UnitMaster::where('unit_kategori_id', 3)->orderby('unit_pengelola_id', 'ASC')->get();
        if (Auth::user()->user_kategori == 1) {
            $Profile = DosenMaster::with('unit_master')->where('id', Auth::user()->user_id)->first();
            $data = 'Dosen';
        } else {
            $Profile = TendikMaster::with('unit_master')->where('id', Auth::user()->user_id)->first();
            $data = 'Tendik';
        }
        return view('auth.profile', compact('Profile', 'UnitMasters', 'data', 'Fakultast', 'Prodis'));
    }

    public function ubah_profile(Request $request, $id)
    {
        $rule = ([
            'user_kategori' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'hp' => 'nullable',
            'alamat' => 'nullable',
            'jabfung' => 'nullable',
            'golongan' => 'nullable',
            'unit_master_id' => 'required',
            'fakultas_id' => 'nullable',
            'prodi_id' => 'nullable',
            'password' => 'min:8|required',
            'konfirmasi_password' => 'same:password'
        ]);

        $user = User::find($request->auth_id);

        if ($request->nomor != $user->nomor) {
            $rule['nomor'] = 'required|unique:users,nomor';
        }

        if ($request->email != $user->email) {
            $rule['email'] = 'email|required|unique:users,email';
        }

        $request->validate($rule);

        DB::beginTransaction();
        if ($request->user_kategori == '1') {
            $dosen = DosenMaster::where('id', $id)->first();

            $dosen->nomor = $request->nomor;
            $dosen->nama = $request->nama;
            $dosen->gender = $request->gender;
            $dosen->hp = $request->hp;
            $dosen->email = $request->email;
            $dosen->alamat = $request->alamat;
            $dosen->jabfung = $request->jabfung;
            $dosen->golongan = $request->golongan;
            $dosen->unit_master_id = $request->unit_master_id;
            $dosen->fakultas_id = $request->fakultas_id;
            $dosen->prodi_id = $request->prodi_id;
            $dosen->password = Hash::make($request->password);
            $dosen->save();

            $user = User::where('id', $request->auth_id)->first();
            $user->nama = $request->nama;
            $user->nomor = $request->nomor;
            $user->unit_master_id = $request->unit_master_id;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
        } else {
            $tendik = TendikMaster::where('id', $id)->first();

            $tendik->nomor = $request->nomor;
            $tendik->nama = $request->nama;
            $tendik->gender = $request->gender;
            $tendik->hp = $request->hp;
            $tendik->email = $request->email;
            $tendik->alamat = $request->alamat;
            $tendik->unit_master_id = $request->unit_master_id;
            $tendik->fakultas_id = $request->fakultas_id;
            $tendik->prodi_id = $request->prodi_id;
            $tendik->password = Hash::make($request->password);
            $tendik->save();

            $user = User::where('id', $request->auth_id)->first();
            $user->nama = $request->nama;
            $user->nomor = $request->nomor;
            $user->unit_master_id = $request->unit_master_id;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
        }

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Akun Berhasil Diubah.'
        ];

        return redirect()->route('profile')->with($message);
    }
}
