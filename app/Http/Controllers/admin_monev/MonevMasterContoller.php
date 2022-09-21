<?php

namespace App\Http\Controllers\admin_monev;

use App\Http\Controllers\Controller;
use App\Models\MonevKategori;
use App\Models\MonevMaster;
use Illuminate\Http\Request;

class MonevMasterContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MonevKategoris = MonevKategori::orderBy('id', 'asc')->get();
        $MonevMasters = MonevMaster::with(['monev_kategori'])->orderBy('monev_kategori_id', 'ASC')->get();
        return view('admin_monev.monev_master', compact('MonevKategoris', 'MonevMasters'));
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
            'monev_kategori_id' => 'required',
            'nm_monev' => 'required|unique:monev_masters,nm_monev',
            'no_monev' => 'max:20',
            'ket' => 'max:255'
        ]);

        MonevMaster::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('monev_master.index')->with($message);
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
        $MonevMasters = MonevMaster::find($id);
        $url = Route('monev_master.update', $MonevMasters->id);
        return response()->json($MonevMasters);
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
        $MonevMasters = MonevMaster::find($id);
        $rule = [
            'monev_kategori_id_m' => 'required',
            'no_monev_m' => 'max:20',
            'ket_m' => 'max:255'
        ];

        if ($request->nm_monev_m != $MonevMasters->nm_monev) {
            $rule['nm_monev_m'] = 'required|unique:monev_masters,nm_monev';
        }

        $request->validate($rule);

        $MonevMasters->monev_kategori_id = $request->monev_kategori_id_m;
        $MonevMasters->nm_monev = $request->nm_monev_m;
        $MonevMasters->no_monev = $request->no_monev_m;
        $MonevMasters->ket = $request->ket_m;
        $MonevMasters->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('monev_master.index')->with($message);
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
