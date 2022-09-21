<?php

namespace App\Http\Controllers\admin_siklus;

use App\Http\Controllers\Controller;
use App\Models\VersiMaster;
use Illuminate\Http\Request;

class VersiMasterContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $VersiMasters = VersiMaster::all();
        return view('admin_siklus.versi_master', compact('VersiMasters'));
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
            'nm_versi' => 'required|unique:versi_masters,nm_versi',
            'no_versi' => 'required|unique:versi_masters,no_versi|max:20',
            'no_pengesahan_versi' => 'max:20',
            'ket' => 'max:255'
        ]);

        VersiMaster::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('master_versi.index')->with($message);
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
        $VersiMasters = VersiMaster::find($id);
        $url = Route('master_versi.update', $VersiMasters->id);
        return response()->json($VersiMasters);
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
        $VersiMasters = VersiMaster::find($id);
        $rule = [
            'no_versi_m' => 'required|max:20',
            'no_pengesahan_versi_m' => 'max:20',
            'ket_m' => 'max:255'
        ];

        if ($request->nm_versi_m != $VersiMasters->nm_versi) {
            $rule['nm_versi_m'] = 'required|unique:versi_masters,nm_versi';
        }

        $request->validate($rule);

        $VersiMasters->nm_versi = $request->nm_versi_m;
        $VersiMasters->no_versi = $request->no_versi_m;
        $VersiMasters->no_pengesahan_versi = $request->no_pengesahan_versi_m;
        $VersiMasters->ket = $request->ket_m;
        $VersiMasters->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('master_versi.index')->with($message);
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
