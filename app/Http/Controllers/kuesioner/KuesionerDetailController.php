<?php

namespace App\Http\Controllers\kuesioner;

use App\Http\Controllers\Controller;
use App\Models\KuesionerDetail;
use App\Models\KuesionerMaster;
use Illuminate\Http\Request;

class KuesionerDetailController extends Controller
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
            'kuesioner_master_id' => 'required',
            'pertanyaan' => 'required',
            'jawaban_1' => 'required',
            'jawaban_2' => 'required',
            'jawaban_3' => 'required',
            'jawaban_4' => 'required',
            'jawaban_5' => 'nullable'
        ]);

        KuesionerDetail::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('kuesioner_detail.show', encrypt($request->kuesioner_master_id))->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $KuesionerMasters = KuesionerMaster::with(['monev_master', 'unit_master'])->where('id', decrypt($id))->first();
        $KuesionerDetails = KuesionerDetail::where('kuesioner_master_id', decrypt($id))->get();
        return view('kuesioner.add_kuesioner', compact('KuesionerMasters', 'KuesionerDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $KuesionerDetails = KuesionerDetail::find($id);
        $url = Route('kuesioner_detail.update', $KuesionerDetails->id);
        return response()->json($KuesionerDetails);
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
        $KuesionerDetails = KuesionerDetail::find($id);
        $rule = [
            'kuesioner_master_id_m' => 'required',
            'pertanyaan_m' => 'required',
            'jawaban_1_m' => 'required',
            'jawaban_2_m' => 'required',
            'jawaban_3_m' => 'required',
            'jawaban_4_m' => 'required',
            'jawaban_5_m' => 'nullable'
        ];

        $request->validate($rule);

        $KuesionerDetails->kuesioner_master_id = $request->kuesioner_master_id_m;
        $KuesionerDetails->pertanyaan = $request->pertanyaan_m;
        $KuesionerDetails->jawaban_1 = $request->jawaban_1_m;
        $KuesionerDetails->jawaban_2 = $request->jawaban_2_m;
        $KuesionerDetails->jawaban_3 = $request->jawaban_3_m;
        $KuesionerDetails->jawaban_4 = $request->jawaban_4_m;
        $KuesionerDetails->jawaban_5 = $request->jawaban_5_m;
        $KuesionerDetails->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('kuesioner_detail.show', encrypt($request->kuesioner_master_id_m))->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $KuesionerDetails = KuesionerDetail::find($id);
        $kuesioner_master_id = $KuesionerDetails->kuesioner_master_id;

        $KuesionerDetails::destroy($id);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Telah di Hapus.'
        ];

        return redirect()->route('kuesioner_detail.show', encrypt($kuesioner_master_id))->with($message);
    }
}
