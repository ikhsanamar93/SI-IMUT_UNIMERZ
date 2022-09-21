@extends('layouts.main')
@section('css')
    <style>
        table,
        th,
        td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            padding-left: 5px !important;
            padding-right: 5px !important;
        }
    </style>
@endsection
@section('title', 'SI-IMUT | Rekap Kosong')
@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Rekapitulasi Survey</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('survey_periode.show', Crypt::encrypt($SurveyPeriodes->monev_master_dokumen_id)) }}"
                            class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <label class="col-form-label-lg">Informasi Survey</label>
                    <table class="table table-borderless" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 15%">Surveyor</th>
                                <th style="width: 3%">:</th>
                                <th>{{ $SurveyPeriodes->unit_master->nm_unit }}</th>
                            </tr>
                            <tr>
                                <th style="width: 15%">Survey Kategori</th>
                                <th style="width: 3%">:</th>
                                <th>{{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}</th>
                            </tr>
                            <tr>
                                <th style="width: 15%">Siklus</th>
                                <th style="width: 3%">:</th>
                                <th>{{ $SurveyPeriodes->mutu_periode->siklus }} /
                                    {{ $SurveyPeriodes->semester }}</th>
                            </tr>
                            <tr>
                                <th style="width: 15%">Responden</th>
                                <th style="width: 3%">:</th>
                                <th>
                                    @if ($SurveyPeriodes->responden_mahasiswa == 1)
                                        <span class="badge badge-info">Mhs</span>
                                    @endif
                                    @if ($SurveyPeriodes->responden_dosen == 1)
                                        <span class="badge badge-warning">Dosen</span>
                                    @endif
                                    @if ($SurveyPeriodes->responden_tendik == 1)
                                        <span class="badge badge-primary">Tendik</span>
                                    @endif
                                    @if ($SurveyPeriodes->responden_alumni == 1)
                                        <span class="badge badge-dark">Alumni</span>
                                    @endif
                                    @if ($SurveyPeriodes->responden_mitra == 1)
                                        <span class="badge badge-danger">Mitra</span>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 15%">Jumlah Responden</th>
                                <th style="width: 3%">:</th>
                                <th><a href="#" class="btn-sm btn-default bg-fuchsia">0
                                        Orang</a>
                                </th>
                            </tr>
                        </thead>
                    </table>

                    <label class="col-form-label-lg">Detail Jumlah Responden</label>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center" style="width: 5%; text-align: top">#
                                </th>
                                <th rowspan="2" class="align-middle text-center">Informasi Jumlah Responden
                                <th class="text-md-center" colspan="5">Unsur Responden</th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center" style="width: 8%">Mahasiswa</th>
                                <th class="align-middle text-center" style="width: 8%">Dosen</th>
                                <th class="align-middle text-center" style="width: 8%">Tendik</th>
                                <th class="align-middle text-center" style="width: 8%">Alumni</th>
                                <th class="align-middle text-center" style="width: 8%">Stakeholder</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-capitalize">Jumlah Responden terhadap
                                    {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                </td>
                                <td class="align-middle text-center" style="width: 8%"></td>
                                <td class="align-middle text-center" style="width: 8%"></td>
                                <td class="align-middle text-center" style="width: 8%"></td>
                                <td class="align-middle text-center" style="width: 8%"></td>
                                <td class="align-middle text-center" style="width: 8%"></td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-capitalize">Persentase Responden terhadap
                                    {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                </td>
                                <td class="align-middle text-center" style="width: 8%">%</td>
                                <td class="align-middle text-center" style="width: 8%">%</td>
                                <td class="align-middle text-center" style="width: 8%">%</td>
                                <td class="align-middle text-center" style="width: 8%">%</td>
                                <td class="align-middle text-center" style="width: 8%">%</td>
                            </tr>
                        </tbody>
                    </table>

                    <label class="col-form-label-lg">Rekap Hasil Respon</label>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center" style="width: 5%; text-align: top">#
                                </th>
                                <th rowspan="2" class="align-middle text-center">Hasil Rekapitulasi Jawaban Responden
                                </th>
                                <th class="text-md-center" colspan="5">Jumlah Pilihan Jawaban</th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center" style="width: 8%">A</th>
                                <th class="align-middle text-center" style="width: 8%">B</th>
                                <th class="align-middle text-center" style="width: 8%">C</th>
                                <th class="align-middle text-center" style="width: 8%">D</th>
                                <th class="align-middle text-center" style="width: 8%">E</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 5%" class="align-middle text-center">1</td>
                                <td>Tidak ditemukan Respon pada survey ini.</td>
                                <td class="align-middle text-center"></td>
                                <td class="align-middle text-center"></td>
                                <td class="align-middle text-center"></td>
                                <td class="align-middle text-center"></td>
                                <td class="align-middle text-center"></td>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-capitalize">Total Responden terhadap
                                    {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                </th>
                                <th class="align-middle text-center" style="width: 8%"></th>
                                <th class="align-middle text-center" style="width: 8%"></th>
                                <th class="align-middle text-center" style="width: 8%"></th>
                                <th class="align-middle text-center" style="width: 8%"></th>
                                <th class="align-middle text-center" style="width: 8%"></th>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-capitalize">Rata-rata Responden terhadap
                                    {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-capitalize">Persentase Responden terhadap
                                    {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                    %</th>
                                <th class="align-middle text-center" style="width: 8%">
                                    %</th>
                                <th class="align-middle text-center" style="width: 8%">
                                    %</th>
                                <th class="align-middle text-center" style="width: 8%">
                                    %</th>
                                <th class="align-middle text-center" style="width: 8%">
                                    %</th>
                            </tr>
                        </tbody>
                    </table>

                    <label class="col-form-label-lg">Persentase Hasil Respon</label>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center" style="width: 5%; text-align: top">#
                                </th>
                                <th rowspan="2" class="align-middle text-center">Persentase Rekapitulasi Jawaban
                                    Responden
                                </th>
                                <th class="text-md-center" colspan="5">Persentase Pilihan Jawaban</th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center" style="width: 8%">A</th>
                                <th class="align-middle text-center" style="width: 8%">B</th>
                                <th class="align-middle text-center" style="width: 8%">C</th>
                                <th class="align-middle text-center" style="width: 8%">D</th>
                                <th class="align-middle text-center" style="width: 8%">E</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 5%" class="align-middle text-center"></td>
                                <td>Tidak ditemukan Respon pada survey ini.</td>
                                <td class="align-middle text-center">%</td>
                                <td class="align-middle text-center">%</td>
                                <td class="align-middle text-center">%</td>
                                <td class="align-middle text-center">%</td>
                                <td class="align-middle text-center">%</td>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-capitalize">Total Responden terhadap
                                    {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                </th>
                                <th class="align-middle text-center" style="width: 8%"></th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                                <th class="align-middle text-center" style="width: 8%">
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-capitalize">Rata-rata Responden terhadap
                                    {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                </th>
                                <th class="align-middle text-center" style="width: 8%">%</th>
                                <th class="align-middle text-center" style="width: 8%">%</th>
                                <th class="align-middle text-center" style="width: 8%">%</th>
                                <th class="align-middle text-center" style="width: 8%">%</th>
                                <th class="align-middle text-center" style="width: 8%">%</th>
                            </tr>
                        </tbody>
                    </table>

                    <label class="col-form-label-lg">Detail Hasil Respon</label>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tr>
                            <td style="width: 5%" class="text-center"></td>
                            <th colspan="4">Tidak ditemukan Respon pada survey ini.</th>
                        </tr>
                        <tr>
                            <td rowspan="7"></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">Pilihan Jawaban</th>
                            <th style="width: 10%" class="text-center">Respon</th>
                            <th style="width: 10%" class="text-center">Persentase</th>

                        </tr>
                        <tr>
                            <td class="text-center" style="width: 5%">A</td>
                            <td></td>
                            <td style="width: 10%" class="text-center"></td>
                            <td style="width: 10%" class="text-center">%
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" style="width: 5%">B</td>
                            <td></td>
                            <td style="width: 10%" class="text-center"></td>
                            <td style="width: 10%" class="text-center">%
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" style="width: 5%">C</td>
                            <td></td>
                            <td style="width: 10%" class="text-center"></td>
                            <td style="width: 10%" class="text-center">%
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" style="width: 5%">D</td>
                            <td></td>
                            <td style="width: 10%" class="text-center"></td>
                            <td style="width: 10%" class="text-center">%
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" style="width: 5%">E</td>
                            <td></td>
                            <td style="width: 10%" class="text-center"></td>
                            <td style="width: 10%" class="text-center">%
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
