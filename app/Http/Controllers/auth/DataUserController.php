<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\DosenMaster;
use App\Models\TendikMaster;
use App\Models\UnitMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::orderby('unit_kategori_id', 'ASC')->get();
        $Fakultast = UnitMaster::where('unit_kategori_id', 2)->get();
        $Prodis = UnitMaster::where('unit_kategori_id', 3)->orderby('unit_pengelola_id', 'ASC')->get();
        $users = User::orderby('user_kategori', 'ASC')->get();
        return view('auth.data_user', compact('users', 'UnitMasters', 'Fakultast', 'Prodis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'user_kategori' => 'required',
            'nomor' => 'required|unique:users,nomor|unique:dosen_masters,nomor|unique:tendik_masters,nomor',
            'nama' => 'required',
            'gender' => 'required',
            'hp' => 'nullable|unique:dosen_masters,hp|unique:tendik_masters,hp',
            'email' => 'email|required|unique:users,email|unique:dosen_masters,email|unique:tendik_masters,email',
            'alamat' => 'nullable',
            'unit_master_id' => 'required',
            'fakultas_id' => 'nullable',
            'prodi_id' => 'nullable',
            'password' => 'min:8|required',
            'konfirmasi_password' => 'same:password'
        ]);

        DB::beginTransaction();
        if ($request->user_kategori == 1) {
            $dosen = DosenMaster::create($validasi);

            $user = new User();
            $user->user_id = $dosen->id;
            $user->nama = $request->nama;
            $user->nomor = $request->nomor;
            $user->user_kategori = $request->user_kategori;
            $user->unit_master_id = $request->unit_master_id;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_aktif = $request->is_aktif;
            $user->save();
            DB::commit();
        } elseif ($request->user_kategori == 2) {
            $tendik = TendikMaster::create($validasi);

            $user = new User();
            $user->user_id = $tendik->id;
            $user->nama = $request->nama;
            $user->nomor = $request->nomor;
            $user->user_kategori = $request->user_kategori;
            $user->unit_master_id = $request->unit_master_id;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_aktif = $request->is_aktif;
            $user->save();
            DB::commit();
        }
        $message = [
            'alert-type' => 'success',
            'message' => 'Data Akun Berhasil Disimpan.'
        ];

        return redirect()->route('data_user.index')->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        if ($users->user_kategori == '1') {
            $data = DosenMaster::where('nomor', $users->nomor)->first();
        } else {
            $data = TendikMaster::where('nomor', $users->nomor)->first();
        }
        $url = Route('data_user.update', $users->id);
        return response()->json([$users, $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule = ([
            'user_kategori_m' => 'required',
            'nama_m' => 'required',
            'gender_m' => 'required',
            'hp_m' => 'nullable',
            'alamat_m' => 'nullable',
            'unit_master_id_m' => 'required',
            'role_m' => 'required',
            'password_m' => 'min:8|required',
            'konfirmasi_password_m' => 'same:password_m',
            'is_aktif_m' => 'nullable'
        ]);

        $users = User::find($id);

        if ($request->nomor_m != $users->nomor) {
            $rule['nomor_m'] = 'required|unique:users,nomor';
        }

        if ($request->email_m != $users->email) {
            $rule['email_m'] = 'email|required|unique:users,email';
        }

        $request->validate($rule);

        DB::beginTransaction();
        if ($request->user_kategori_m == '1') {
            DosenMaster::where('id', $request->user_id)->update([
                'user_kategori' => $request->user_kategori_m,
                'nomor' => $request->nomor_m,
                'nama' => $request->nama_m,
                'gender' => $request->gender_m,
                'hp' => $request->hp_m,
                'email' => $request->email_m,
                'alamat' => $request->alamat_m,
                'jabfung' => $request->jabfung,
                'golongan' => $request->golongan,
                'unit_master_id' => $request->unit_master_id_m,
                'fakultas_id' => $request->fakultas_id_m,
                'prodi_id' => $request->prodi_id_m,
                'password' => Hash::make($request->password_m)
            ]);
            User::where('id', $id)->update([
                'nomor' => $request->nomor_m,
                'nama' => $request->nama_m,
                'user_kategori' => $request->user_kategori_m,
                'email' => $request->email_m,
                'unit_master_id' => $request->unit_master_id_m,
                'role' => $request->role_m,
                'is_aktif' => $request->is_aktif_m,
                'password' => Hash::make($request->password_m)
            ]);
            DB::commit();
        } else {
            TendikMaster::where('id', $request->user_id)->update([
                'user_kategori' => $request->user_kategori_m,
                'nomor' => $request->nomor_m,
                'nama' => $request->nama_m,
                'gender' => $request->gender_m,
                'hp' => $request->hp_m,
                'email' => $request->email_m,
                'alamat' => $request->alamat_m,
                'unit_master_id' => $request->unit_master_id_m,
                'fakultas_id' => $request->fakultas_id_m,
                'prodi_id' => $request->prodi_id_m,
                'password' => Hash::make($request->password_m)
            ]);
            User::where('id', $id)->update([
                'nomor' => $request->nomor_m,
                'nama' => $request->nama_m,
                'user_kategori' => $request->user_kategori_m,
                'email' => $request->email_m,
                'unit_master_id' => $request->unit_master_id_m,
                'role' => $request->role_m,
                'is_aktif' => $request->is_aktif_m,
                'password' => Hash::make($request->password_m)
            ]);
            DB::commit();
        }

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Akun Berhasil Diubah.'
        ];

        return redirect()->route('data_user.index')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
