<?php

namespace App\Http\Controllers\survey;

use App\Http\Controllers\Controller;
use App\Models\ResponDetail;
use App\Models\ResponMaster;
use App\Models\SurveyPeriode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\assertSame;

class RekapSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //Cetak Grafik
        $SurveyPeriodes = SurveyPeriode::find(decrypt($id));

        $JumlahRespon = ResponMaster::where('survey_periode_id', decrypt($id))->count();
        $JumlahMahasiswa = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 1)->count();
        $JumlahDosen = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 2)->count();
        $JumlahTendik = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 3)->count();
        $JumlahAlumni = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 4)->count();
        $JumlahMitra = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 5)->count();

        if ($JumlahRespon == 0) {
            return view(
                'periode_survey.rekap_kosong',
                compact(
                    'SurveyPeriodes',
                    'JumlahRespon'
                )
            );
        } else {
            $persentase = [
                'mahasiswa' => ($JumlahMahasiswa * 100) / $JumlahRespon,
                'dosen' => ($JumlahDosen * 100) / $JumlahRespon,
                'tendik' => ($JumlahTendik * 100) / $JumlahRespon,
                'alumni' => ($JumlahAlumni * 100) / $JumlahRespon,
                'mitra' => ($JumlahMitra * 100) / $JumlahRespon
            ];

            //sum jawaban
            $TotalRespon = ResponDetail::select(
                DB::raw("sum(jawaban_1)as Jawaban_A"),
                DB::raw("sum(jawaban_2)as Jawaban_B"),
                DB::raw("sum(jawaban_3)as Jawaban_C"),
                DB::raw("sum(jawaban_4)as Jawaban_D"),
                DB::raw("sum(jawaban_5)as Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->first();

            // dd($RerataRespon->Jawaban_A);
            //detail jawaban count
            $ResponDetails = ResponDetail::select(
                "kuesioner_detail_id",
                DB::raw("count(if(jawaban_1 = 1, 1, NULL))Jawaban_A"),
                DB::raw("count(if(jawaban_2 = 1, 1, NULL))Jawaban_B"),
                DB::raw("count(if(jawaban_3 = 1, 1, NULL))Jawaban_C"),
                DB::raw("count(if(jawaban_4 = 1, 1, NULL))Jawaban_D"),
                DB::raw("count(if(jawaban_5 = 1, 1, NULL))Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->groupBy(DB::raw("kuesioner_detail_id"))
                ->get();

            $soal = $ResponDetails->count();

            foreach ($ResponDetails as $ResponDetail) {
                $data[] = [
                    'title' => strip_tags($ResponDetail->kuesioner_detail->pertanyaan),
                    'name' => "Jawaban",
                    'data' => [
                        ["Jawaban A", $ResponDetail->Jawaban_A],
                        ["Jawaban B", $ResponDetail->Jawaban_B],
                        ["Jawaban C", $ResponDetail->Jawaban_C],
                        ["Jawaban D", $ResponDetail->Jawaban_D],
                        ["Jawaban E", $ResponDetail->Jawaban_E]
                    ]
                ];
            }

            // $pdf = PDF::loadView(
            //     'periode_survey.cetak_grafik',
            //     compact(
            //         'SurveyPeriodes',
            //         'TotalRespon',
            //         'ResponDetails',
            //         'JumlahRespon',
            //         'JumlahMahasiswa',
            //         'JumlahDosen',
            //         'JumlahTendik',
            //         'JumlahAlumni',
            //         'JumlahMitra',
            //         'persentase',
            //         'soal',
            //         'data'
            //     )
            // )->setPaper('A4', 'landscape');
            // return $pdf->stream();
            // return $pdf;

            return view(
                'periode_survey.cetak_grafik',
                compact(
                    'SurveyPeriodes',
                    'TotalRespon',
                    'ResponDetails',
                    'JumlahRespon',
                    'JumlahMahasiswa',
                    'JumlahDosen',
                    'JumlahTendik',
                    'JumlahAlumni',
                    'JumlahMitra',
                    'persentase',
                    'soal',
                    'data'
                )
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $kategori)
    {
        //rekap_survey_kategori
        if ($kategori == 1) {
            $data = 'Mahasiswa';
        } elseif ($kategori == 2) {
            $data = 'Dosen';
        } elseif ($kategori == 3) {
            $data = 'Tendik';
        } elseif ($kategori == 4) {
            $data = 'Alumni';
        } elseif ($kategori == 5) {
            $data = 'Stakeholder';
        }
        $responden = $kategori;

        $SurveyPeriodes = SurveyPeriode::find(decrypt($id));

        $JumlahRespon = ResponMaster::where('survey_periode_id', decrypt($id))->count();
        $JumlahKategori = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', $kategori)->count();

        if ($JumlahKategori == 0) {
            return view(
                'periode_survey.rekap_kosong',
                compact(
                    'SurveyPeriodes',
                    'JumlahRespon'
                )
            );
        } else {
            $persentase = [
                'kategori' => ($JumlahKategori * 100) / $JumlahRespon
            ];

            //sum jawaban
            $TotalRespon = ResponDetail::select(
                DB::raw("sum(jawaban_1)as Jawaban_A"),
                DB::raw("sum(jawaban_2)as Jawaban_B"),
                DB::raw("sum(jawaban_3)as Jawaban_C"),
                DB::raw("sum(jawaban_4)as Jawaban_D"),
                DB::raw("sum(jawaban_5)as Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->where('responden_kategori', $kategori)
                ->first();

            //detail jawaban count
            $ResponDetails = ResponDetail::select(
                "kuesioner_detail_id",
                DB::raw("count(if(jawaban_1 = 1, 1, NULL))Jawaban_A"),
                DB::raw("count(if(jawaban_2 = 1, 1, NULL))Jawaban_B"),
                DB::raw("count(if(jawaban_3 = 1, 1, NULL))Jawaban_C"),
                DB::raw("count(if(jawaban_4 = 1, 1, NULL))Jawaban_D"),
                DB::raw("count(if(jawaban_5 = 1, 1, NULL))Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->where('responden_kategori', $kategori)
                ->groupBy(DB::raw("kuesioner_detail_id"))
                ->get();

            $soal = $ResponDetails->count();

            foreach ($ResponDetails as $ResponDetail) {
                $data_jawaban[] = [
                    'title' => strip_tags($ResponDetail->kuesioner_detail->pertanyaan),
                    'name' => "Jawaban",
                    'data' => [
                        ["Jawaban A", $ResponDetail->Jawaban_A],
                        ["Jawaban B", $ResponDetail->Jawaban_B],
                        ["Jawaban C", $ResponDetail->Jawaban_C],
                        ["Jawaban D", $ResponDetail->Jawaban_D],
                        ["Jawaban E", $ResponDetail->Jawaban_E]
                    ]
                ];
            }

            return view(
                'periode_survey.rekap_survey_kategori',
                compact(
                    'SurveyPeriodes',
                    'TotalRespon',
                    'ResponDetails',
                    'JumlahRespon',
                    'JumlahKategori',
                    'persentase',
                    'soal',
                    'data',
                    'data_jawaban',
                    'responden'
                )
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //rekap_survey
        //Table dan Grafik
        $SurveyPeriodes = SurveyPeriode::find(decrypt($id));

        $JumlahRespon = ResponMaster::where('survey_periode_id', decrypt($id))->count();
        $JumlahMahasiswa = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 1)->count();
        $JumlahDosen = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 2)->count();
        $JumlahTendik = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 3)->count();
        $JumlahAlumni = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 4)->count();
        $JumlahMitra = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 5)->count();

        if ($JumlahRespon == 0) {
            return view(
                'periode_survey.rekap_kosong',
                compact(
                    'SurveyPeriodes',
                    'JumlahRespon'
                )
            );
        } else {
            $persentase = [
                'mahasiswa' => ($JumlahMahasiswa * 100) / $JumlahRespon,
                'dosen' => ($JumlahDosen * 100) / $JumlahRespon,
                'tendik' => ($JumlahTendik * 100) / $JumlahRespon,
                'alumni' => ($JumlahAlumni * 100) / $JumlahRespon,
                'mitra' => ($JumlahMitra * 100) / $JumlahRespon
            ];

            //sum jawaban
            $TotalRespon = ResponDetail::select(
                DB::raw("sum(jawaban_1)as Jawaban_A"),
                DB::raw("sum(jawaban_2)as Jawaban_B"),
                DB::raw("sum(jawaban_3)as Jawaban_C"),
                DB::raw("sum(jawaban_4)as Jawaban_D"),
                DB::raw("sum(jawaban_5)as Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->first();

            // dd($RerataRespon->Jawaban_A);
            //detail jawaban count
            $ResponDetails = ResponDetail::select(
                "kuesioner_detail_id",
                DB::raw("count(if(jawaban_1 = 1, 1, NULL))Jawaban_A"),
                DB::raw("count(if(jawaban_2 = 1, 1, NULL))Jawaban_B"),
                DB::raw("count(if(jawaban_3 = 1, 1, NULL))Jawaban_C"),
                DB::raw("count(if(jawaban_4 = 1, 1, NULL))Jawaban_D"),
                DB::raw("count(if(jawaban_5 = 1, 1, NULL))Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->groupBy(DB::raw("kuesioner_detail_id"))
                ->get();

            $soal = $ResponDetails->count();

            foreach ($ResponDetails as $ResponDetail) {
                $data[] = [
                    'title' => strip_tags($ResponDetail->kuesioner_detail->pertanyaan),
                    'name' => "Jawaban",
                    'data' => [
                        ["Jawaban A", $ResponDetail->Jawaban_A],
                        ["Jawaban B", $ResponDetail->Jawaban_B],
                        ["Jawaban C", $ResponDetail->Jawaban_C],
                        ["Jawaban D", $ResponDetail->Jawaban_D],
                        ["Jawaban E", $ResponDetail->Jawaban_E]
                    ]
                ];
            }

            return view(
                'periode_survey.rekap_survey',
                compact(
                    'SurveyPeriodes',
                    'TotalRespon',
                    'ResponDetails',
                    'JumlahRespon',
                    'JumlahMahasiswa',
                    'JumlahDosen',
                    'JumlahTendik',
                    'JumlahAlumni',
                    'JumlahMitra',
                    'persentase',
                    'soal',
                    'data'
                )
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Cetak Rekap Survey
        $SurveyPeriodes = SurveyPeriode::find(decrypt($id));

        $JumlahRespon = ResponMaster::where('survey_periode_id', decrypt($id))->count();
        $JumlahMahasiswa = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 1)->count();
        $JumlahDosen = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 2)->count();
        $JumlahTendik = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 3)->count();
        $JumlahAlumni = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 4)->count();
        $JumlahMitra = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', 5)->count();

        if ($JumlahRespon == 0) {
            return view(
                'periode_survey.rekap_kosong',
                compact(
                    'SurveyPeriodes',
                    'JumlahRespon'
                )
            );
        } else {
            $persentase = [
                'mahasiswa' => ($JumlahMahasiswa * 100) / $JumlahRespon,
                'dosen' => ($JumlahDosen * 100) / $JumlahRespon,
                'tendik' => ($JumlahTendik * 100) / $JumlahRespon,
                'alumni' => ($JumlahAlumni * 100) / $JumlahRespon,
                'mitra' => ($JumlahMitra * 100) / $JumlahRespon
            ];

            //sum jawaban
            $TotalRespon = ResponDetail::select(
                DB::raw("sum(jawaban_1)as Jawaban_A"),
                DB::raw("sum(jawaban_2)as Jawaban_B"),
                DB::raw("sum(jawaban_3)as Jawaban_C"),
                DB::raw("sum(jawaban_4)as Jawaban_D"),
                DB::raw("sum(jawaban_5)as Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->first();

            // dd($RerataRespon->Jawaban_A);
            //detail jawaban count
            $ResponDetails = ResponDetail::select(
                "kuesioner_detail_id",
                DB::raw("count(if(jawaban_1 = 1, 1, NULL))Jawaban_A"),
                DB::raw("count(if(jawaban_2 = 1, 1, NULL))Jawaban_B"),
                DB::raw("count(if(jawaban_3 = 1, 1, NULL))Jawaban_C"),
                DB::raw("count(if(jawaban_4 = 1, 1, NULL))Jawaban_D"),
                DB::raw("count(if(jawaban_5 = 1, 1, NULL))Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->groupBy(DB::raw("kuesioner_detail_id"))
                ->get();

            $soal = $ResponDetails->count();

            $pdf = PDF::loadView(
                'periode_survey.cetak_periode',
                compact(
                    'SurveyPeriodes',
                    'TotalRespon',
                    'ResponDetails',
                    'JumlahRespon',
                    'JumlahMahasiswa',
                    'JumlahDosen',
                    'JumlahTendik',
                    'JumlahAlumni',
                    'JumlahMitra',
                    'persentase',
                    'soal'
                )
            )->setPaper('A4', 'landscape');
            return $pdf->stream();
            return $pdf;

            // return view(
            //     'periode_survey.cetak_periode',
            //     compact(
            //         'SurveyPeriodes',
            //         'TotalRespon',
            //         'ResponDetails',
            //         'JumlahRespon',
            //         'JumlahMahasiswa',
            //         'JumlahDosen',
            //         'JumlahTendik',
            //         'JumlahAlumni',
            //         'JumlahMitra',
            //         'persentase',
            //         'soal'
            //     )
            // );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $kategori)
    {
        //Cetak Tabel Kategori
        if ($kategori == 1) {
            $data = 'Mahasiswa';
        } elseif ($kategori == 2) {
            $data = 'Dosen';
        } elseif ($kategori == 3) {
            $data = 'Tendik';
        } elseif ($kategori == 4) {
            $data = 'Alumni';
        } elseif ($kategori == 5) {
            $data = 'Stakeholder';
        }

        // dd($kategori);

        $SurveyPeriodes = SurveyPeriode::find(decrypt($id));

        $JumlahRespon = ResponMaster::where('survey_periode_id', decrypt($id))->count();
        $JumlahKategori = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', $kategori)->count();

        if ($JumlahKategori == 0) {
            return view(
                'periode_survey.rekap_kosong',
                compact(
                    'SurveyPeriodes',
                    'JumlahRespon'
                )
            );
        } else {
            $persentase = [
                'kategori' => ($JumlahKategori * 100) / $JumlahRespon
            ];

            //sum jawaban
            $TotalRespon = ResponDetail::select(
                DB::raw("sum(jawaban_1)as Jawaban_A"),
                DB::raw("sum(jawaban_2)as Jawaban_B"),
                DB::raw("sum(jawaban_3)as Jawaban_C"),
                DB::raw("sum(jawaban_4)as Jawaban_D"),
                DB::raw("sum(jawaban_5)as Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->where('responden_kategori', $kategori)
                ->first();

            //detail jawaban count
            $ResponDetails = ResponDetail::select(
                "kuesioner_detail_id",
                DB::raw("count(if(jawaban_1 = 1, 1, NULL))Jawaban_A"),
                DB::raw("count(if(jawaban_2 = 1, 1, NULL))Jawaban_B"),
                DB::raw("count(if(jawaban_3 = 1, 1, NULL))Jawaban_C"),
                DB::raw("count(if(jawaban_4 = 1, 1, NULL))Jawaban_D"),
                DB::raw("count(if(jawaban_5 = 1, 1, NULL))Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->where('responden_kategori', $kategori)
                ->groupBy(DB::raw("kuesioner_detail_id"))
                ->get();

            $soal = $ResponDetails->count();

            foreach ($ResponDetails as $ResponDetail) {
                $data_jawaban[] = [
                    'title' => strip_tags($ResponDetail->kuesioner_detail->pertanyaan),
                    'name' => "Jawaban",
                    'data' => [
                        ["Jawaban A", $ResponDetail->Jawaban_A],
                        ["Jawaban B", $ResponDetail->Jawaban_B],
                        ["Jawaban C", $ResponDetail->Jawaban_C],
                        ["Jawaban D", $ResponDetail->Jawaban_D],
                        ["Jawaban E", $ResponDetail->Jawaban_E]
                    ]
                ];
            }

            $pdf = Pdf::loadView(
                'periode_survey.cetak_kategori',
                compact(
                    'SurveyPeriodes',
                    'TotalRespon',
                    'ResponDetails',
                    'JumlahRespon',
                    'JumlahKategori',
                    'persentase',
                    'soal',
                    'data',
                    'data_jawaban'
                )
            )->setPaper('A4', 'landscape');
            return $pdf->stream();
            return $pdf;

            // return view(
            //     'periode_survey.cetak_kategori',
            //     compact(
            //         'SurveyPeriodes',
            //         'TotalRespon',
            //         'ResponDetails',
            //         'JumlahRespon',
            //         'JumlahKategori',
            //         'persentase',
            //         'soal',
            //         'data',
            //         'data_jawaban'
            //     )
            // );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $kategori)
    {
        //Cetak Grafik Kategori
        if ($kategori == 1) {
            $data = 'Mahasiswa';
        } elseif ($kategori == 2) {
            $data = 'Dosen';
        } elseif ($kategori == 3) {
            $data = 'Tendik';
        } elseif ($kategori == 4) {
            $data = 'Alumni';
        } elseif ($kategori == 5) {
            $data = 'Stakeholder';
        }

        $SurveyPeriodes = SurveyPeriode::find(decrypt($id));

        $JumlahRespon = ResponMaster::where('survey_periode_id', decrypt($id))->count();
        $JumlahKategori = ResponMaster::where('survey_periode_id', decrypt($id))->where('responden_kategori', $kategori)->count();

        if ($JumlahKategori == 0) {
            return view(
                'periode_survey.rekap_kosong',
                compact(
                    'SurveyPeriodes',
                    'JumlahRespon'
                )
            );
        } else {
            $persentase = [
                'kategori' => ($JumlahKategori * 100) / $JumlahRespon
            ];

            //sum jawaban
            $TotalRespon = ResponDetail::select(
                DB::raw("sum(jawaban_1)as Jawaban_A"),
                DB::raw("sum(jawaban_2)as Jawaban_B"),
                DB::raw("sum(jawaban_3)as Jawaban_C"),
                DB::raw("sum(jawaban_4)as Jawaban_D"),
                DB::raw("sum(jawaban_5)as Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->where('responden_kategori', $kategori)
                ->first();

            //detail jawaban count
            $ResponDetails = ResponDetail::select(
                "kuesioner_detail_id",
                DB::raw("count(if(jawaban_1 = 1, 1, NULL))Jawaban_A"),
                DB::raw("count(if(jawaban_2 = 1, 1, NULL))Jawaban_B"),
                DB::raw("count(if(jawaban_3 = 1, 1, NULL))Jawaban_C"),
                DB::raw("count(if(jawaban_4 = 1, 1, NULL))Jawaban_D"),
                DB::raw("count(if(jawaban_5 = 1, 1, NULL))Jawaban_E")
            )
                ->where('survey_periode_id', decrypt($id))
                ->where('responden_kategori', $kategori)
                ->groupBy(DB::raw("kuesioner_detail_id"))
                ->get();

            $soal = $ResponDetails->count();

            foreach ($ResponDetails as $ResponDetail) {
                $data_jawaban[] = [
                    'title' => strip_tags($ResponDetail->kuesioner_detail->pertanyaan),
                    'name' => "Jawaban",
                    'data' => [
                        ["Jawaban A", $ResponDetail->Jawaban_A],
                        ["Jawaban B", $ResponDetail->Jawaban_B],
                        ["Jawaban C", $ResponDetail->Jawaban_C],
                        ["Jawaban D", $ResponDetail->Jawaban_D],
                        ["Jawaban E", $ResponDetail->Jawaban_E]
                    ]
                ];
            }

            return view(
                'periode_survey.cetak_grafik_kategori',
                compact(
                    'SurveyPeriodes',
                    'TotalRespon',
                    'ResponDetails',
                    'JumlahRespon',
                    'JumlahKategori',
                    'persentase',
                    'soal',
                    'data',
                    'data_jawaban'
                )
            );
        }
    }
}
