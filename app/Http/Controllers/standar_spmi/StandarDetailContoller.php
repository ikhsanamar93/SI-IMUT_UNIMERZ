<?php

namespace App\Http\Controllers\standar_spmi;

use App\Http\Controllers\Controller;
use App\Models\SpmiStandarDetail;
use App\Models\SpmiStandarMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StandarDetailContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'spmi_standar_master_id' => 'required',
            'unit_master_id' => 'required',
            'poin' => 'required',
            'pernyataan' => 'required',
            'strategi' => 'required',
            'indikator' => 'required'
        ]);

        $cek = SpmiStandarDetail::where('spmi_standar_master_id', '=', $request->spmi_standar_master_id, 'and')->where('poin', '=', $request->poin)->first();
        if ($cek != null) {
            $message = [
                'alert-type' => 'error',
                'message' => 'Gagal Tersimpan, Poin Standar Sudah Digunakan!!!'
            ];
            return redirect()->route('standar_detail.show', Crypt::encrypt($request->spmi_standar_master_id))->with($message);
        } else {
            SpmiStandarDetail::create($validasi);
            $message = [
                'alert-type' => 'success',
                'message' => 'Data Tersimpan.'
            ];
            return redirect()->route('standar_detail.show', Crypt::encrypt($request->spmi_standar_master_id))->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SpmiStandarMasters = SpmiStandarMaster::find(decrypt($id));
        //dd($StandarSpmimasters);
        return view('standar_spmi.standar_detail', compact('SpmiStandarMasters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SpmiStandardetails = SpmiStandarDetail::with(['spmi_standar_master'])->where('id', decrypt($id))->first();
        $SpmiStandarMasters = SpmiStandarMaster::with(['unit_master'])->where('id', $SpmiStandardetails->spmi_standar_master_id)->first();
        // dd($SpmiStandarMasters);
        return view('standar_spmi.edit_detail', compact('SpmiStandardetails', 'SpmiStandarMasters'));
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
        // return $request->all();
        $validasi = $request->validate([
            'spmi_standar_master_id' => 'required',
            'unit_master_id' => 'required',
            'poin' => 'required',
            'pernyataan' => 'required',
            'strategi' => 'required',
            'indikator' => 'required'
        ]);

        SpmiStandarDetail::where('id', $request->id)->update($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('standar_master.show', Crypt::encrypt($request->unit_master_id))->with($message);
        // }
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
