<?php

namespace App\Http\Controllers\respon;

use App\Http\Controllers\Controller;
use App\Models\AlumniMaster;
use App\Models\DosenMaster;
use App\Models\KuesionerDetail;
use App\Models\MahasiswaMaster;
use App\Models\MitraMaster;
use App\Models\ResponDetail;
use App\Models\ResponMaster;
use App\Models\SurveyPeriode;
use App\Models\TendikMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nomor = $request->nomor;
        if ($request->responden_kategori == '1') {
            return redirect()->route('list_survey_mahasiswa', compact('nomor'));
        } elseif ($request->responden_kategori == '2') {
            return redirect()->route('list_survey_dosen', compact('nomor'));
        } elseif ($request->responden_kategori == '3') {
            return redirect()->route('list_survey_tendik', compact('nomor'));
        } elseif ($request->responden_kategori == '4') {
            return redirect()->route('list_survey_alumni', compact('nomor'));
        } elseif ($request->responden_kategori == '5') {
            return redirect()->route('list_survey_mitra', compact('nomor'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        if ($request->target == '1') {
            $data = MahasiswaMaster::with('unit_master')->where('id', $request->id)->first();
            $kategori = '1';
            $target = '1';
        } elseif ($request->target == '2') {
            $data = DosenMaster::with('unit_master')->where('id', $request->id)->first();
            $kategori = '2';
            $target = '2';
        } elseif ($request->target == '3') {
            $data = TendikMaster::with('unit_master')->where('id', $request->id)->first();
            $kategori = '3';
            $target = '3';
        } elseif ($request->target == '4') {
            $data = AlumniMaster::with('unit_master')->where('id', $request->id)->first();
            $kategori = '4';
            $target = '4';
        } elseif ($request->target == '5') {
            $data = MitraMaster::with('unit_master')->where('id', $request->id)->first();
            $kategori = '5';
            $target = '5';
        }

        $SurveyPeriode = SurveyPeriode::with(['unit_master', 'mutu_periode', 'kuesioner_master'])->where('id', $request->survey_periode_id)->first();
        // dd($SurveyPeriode);
        $KuesionerDetails = KuesionerDetail::with(['kuesioner_master'])->where('kuesioner_master_id', decrypt($id))->get();

        return view(
            'home.respon.respon',
            compact(
                'KuesionerDetails',
                'data',
                'SurveyPeriode',
                'kategori',
                'target'
            )
        );
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
            'survey_periode_id' => 'required',
            'unit_master_id' => 'required',
            'mutu_periode_id' => 'required',
            'kuesioner_master_id' => 'required',
            'responden_kategori' => 'required',
            'responden_target' => 'required',
            'responden_id' => 'required',
            'responden_ket' => 'nullable'
        ]);

        DB::beginTransaction();

        $data = ResponMaster::create($validasi);
        $getid = $data->id;

        // $data = new ResponMaster($validasi);

        $KuesionerDetails = KuesionerDetail::where('kuesioner_master_id', $request->kuesioner_master_id)->get();
        // dd($KuesionerDetails);
        foreach ($KuesionerDetails as $KuesionerDetail) {
            if ($request->jawaban[$KuesionerDetail->id] == '1') {
                $jawaban_1 = '1';
                $jawaban_2 = '0';
                $jawaban_3 = '0';
                $jawaban_4 = '0';
                $jawaban_5 = '0';
            } elseif ($request->jawaban[$KuesionerDetail->id] == '2') {
                $jawaban_1 = '0';
                $jawaban_2 = '1';
                $jawaban_3 = '0';
                $jawaban_4 = '0';
                $jawaban_5 = '0';
            } elseif ($request->jawaban[$KuesionerDetail->id] == '3') {
                $jawaban_1 = '0';
                $jawaban_2 = '0';
                $jawaban_3 = '1';
                $jawaban_4 = '0';
                $jawaban_5 = '0';
            } elseif ($request->jawaban[$KuesionerDetail->id] == '4') {
                $jawaban_1 = '0';
                $jawaban_2 = '0';
                $jawaban_3 = '0';
                $jawaban_4 = '1';
                $jawaban_5 = '0';
            } elseif ($request->jawaban[$KuesionerDetail->id] == '5') {
                $jawaban_1 = '0';
                $jawaban_2 = '0';
                $jawaban_3 = '0';
                $jawaban_4 = '0';
                $jawaban_5 = '1';
            }
            // echo "ID " . $KuesionerDetail->id . "<br>";

            $newrespon = new ResponDetail();
            $newrespon->respon_master_id = $getid;
            $newrespon->survey_periode_id = $request->survey_periode_id;
            $newrespon->unit_master_id = $request->unit_master_id;
            $newrespon->mutu_periode_id = $request->mutu_periode_id;
            $newrespon->kuesioner_master_id = $request->kuesioner_master_id;
            $newrespon->kuesioner_detail_id = $KuesionerDetail->id;
            $newrespon->responden_kategori = $request->responden_kategori;
            $newrespon->responden_id = $request->responden_id;
            $newrespon->jawaban = $request->jawaban[$KuesionerDetail->id];
            $newrespon->jawaban_1 = $jawaban_1;
            $newrespon->jawaban_2 = $jawaban_2;
            $newrespon->jawaban_3 = $jawaban_3;
            $newrespon->jawaban_4 = $jawaban_4;
            $newrespon->jawaban_5 = $jawaban_5;
            $newrespon->save();
            DB::commit();
        }

        $message = [
            'alert-type' => 'success',
            'message' => 'Terma Kasih, Survey anda telah tersimpan.'
        ];

        $nomor = $request->nomor;
        if ($request->responden_kategori == '1') {
            return redirect()->route('list_survey_mahasiswa', compact('nomor'))->with($message);;
        } elseif ($request->responden_kategori == '2') {
            return redirect()->route('list_survey_dosen', compact('nomor'))->with($message);;
        } elseif ($request->responden_kategori == '3') {
            return redirect()->route('list_survey_tendik', compact('nomor'))->with($message);;
        } elseif ($request->responden_kategori == '4') {
            return redirect()->route('list_survey_alumni', compact('nomor'))->with($message);;
        } elseif ($request->responden_kategori == '5') {
            return redirect()->route('list_survey_mitra', compact('nomor'))->with($message);;
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
        //
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
        //
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
