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
@section('title', 'SI-IMUT | Rekap Kategori')
@section('content')
    <div class="col-md-12">
        <a target="_blank" href="{{ route('cetak_tabel_kategori', [Crypt::encrypt($SurveyPeriodes->id), $responden]) }}"
            class="btn btn-info">
            <i class="fa fa-table-cells-large"></i> Print Tabel</a>
        <a target="_blank" href="{{ route('cetak_grafik_kategori', [Crypt::encrypt($SurveyPeriodes->id), $responden]) }}"
            class="btn btn-warning">
            <i class="fa fa-chart-pie"></i> Print Grafik</a>
        <a href="{{ route('survey_periode.show', Crypt::encrypt($SurveyPeriodes->monev_master_dokumen_id)) }}"
            class="btn btn-danger"><i class="fa fa-backspace"></i> Kembali</a>
        <p></p>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-dark card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#rekapitulasi"
                            role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Rekapitulasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#grafik"
                            role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Grafik</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="rekapitulasi" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">

                        <div class="table-responsive">
                            <label class="col-form-label-lg">Informasi Survey {{ $data }}</label>
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
                                            <span class="badge badge-info">{{ $data }}</span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 15%">Jumlah Responden</th>
                                        <th style="width: 3%">:</th>
                                        <th><a href="#" class="btn-sm btn-default bg-fuchsia">{{ $JumlahKategori }}
                                                Orang</a>
                                        </th>
                                    </tr>
                                </thead>
                            </table>

                            <label class="col-form-label-lg">Detail Jumlah Responden</label>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center" style="width: 5%; text-align: top">#</th>
                                        <th class="align-middle text-center">Informasi Jumlah Responden
                                        <th class="align-middle text-center" style="width: 30%">Rekap Responden</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-capitalize">Total Responden terhadap
                                            {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                        </td>
                                        <td class="align-middle text-center" style="width: 30%">{{ $JumlahRespon }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="text-capitalize">Responden {{ $data }} terhadap
                                            {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                        </td>
                                        <td class="align-middle text-center" style="width: 30%">{{ $JumlahKategori }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td class="text-capitalize">Persentase Responden {{ $data }} terhadap
                                            {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                        </td>
                                        <td class="align-middle text-center" style="width: 30%">
                                            {{ Round($persentase['kategori'], 2) }} %
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <label class="col-form-label-lg">Rekap Hasil Respon</label>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="align-middle text-center"
                                            style="width: 5%; text-align: top">
                                            #</th>
                                        <th rowspan="2" class="align-middle text-center">Hasil Rekapitulasi Jawaban
                                            Responden</th>
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
                                    @foreach ($ResponDetails as $ResponDetail)
                                        <tr>
                                            <td style="width: 5%" class="align-middle text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{!! strip_tags($ResponDetail->kuesioner_detail->pertanyaan) !!}</td>
                                            <td class="align-middle text-center">{{ $ResponDetail->Jawaban_A }}</td>
                                            <td class="align-middle text-center">{{ $ResponDetail->Jawaban_B }}</td>
                                            <td class="align-middle text-center">{{ $ResponDetail->Jawaban_C }}</td>
                                            <td class="align-middle text-center">{{ $ResponDetail->Jawaban_D }}</td>
                                            <td class="align-middle text-center">{{ $ResponDetail->Jawaban_E }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-capitalize">Total Responden terhadap
                                            {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_A }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_B }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_C }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_D }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_E }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-capitalize">Rata-rata Responden terhadap
                                            {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round($TotalRespon->Jawaban_A / $soal, 2) }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round($TotalRespon->Jawaban_B / $soal, 2) }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round($TotalRespon->Jawaban_C / $soal, 2) }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round($TotalRespon->Jawaban_D / $soal, 2) }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round($TotalRespon->Jawaban_E / $soal, 2) }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-capitalize">Persentase Responden terhadap
                                            {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_A / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_B / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_C / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_D / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_E / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                    </tr>
                                </tbody>
                            </table>

                            <label class="col-form-label-lg">Persentase Hasil Respon</label>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="align-middle text-center"
                                            style="width: 5%; text-align: top">
                                            #</th>
                                        <th rowspan="2" class="align-middle text-center">Persentase Rekapitulasi
                                            Jawaban
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
                                    @foreach ($ResponDetails as $ResponDetail)
                                        <tr>
                                            <td style="width: 5%" class="align-middle text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{!! strip_tags($ResponDetail->kuesioner_detail->pertanyaan) !!}</td>
                                            <td class="align-middle text-center">
                                                {{ Round(($ResponDetail->Jawaban_A / $JumlahKategori) * 100, 2) }} %</td>
                                            <td class="align-middle text-center">
                                                {{ Round(($ResponDetail->Jawaban_B / $JumlahKategori) * 100, 2) }} %</td>
                                            <td class="align-middle text-center">
                                                {{ Round(($ResponDetail->Jawaban_C / $JumlahKategori) * 100, 2) }} %</td>
                                            <td class="align-middle text-center">
                                                {{ Round(($ResponDetail->Jawaban_D / $JumlahKategori) * 100, 2) }} %</td>
                                            <td class="align-middle text-center">
                                                {{ Round(($ResponDetail->Jawaban_E / $JumlahKategori) * 100, 2) }} %</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-capitalize">Total Responden terhadap
                                            {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_A }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_B }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_C }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_D }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ $TotalRespon->Jawaban_E }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-capitalize">Rata-rata Responden terhadap
                                            {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_A / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_B / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_C / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_D / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                        <th class="align-middle text-center" style="width: 8%">
                                            {{ Round((($TotalRespon->Jawaban_E / $soal) * 100) / $JumlahKategori, 2) }} %
                                        </th>
                                    </tr>
                                </tbody>
                            </table>

                            <label class="col-form-label-lg">Detail Hasil Respon</label>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                @foreach ($ResponDetails as $ResponDetail)
                                    <tr>
                                        <td style="width: 5%" class="text-center">{{ $loop->iteration }}</td>
                                        <th colspan="4">{!! strip_tags($ResponDetail->kuesioner_detail->pertanyaan) !!}</th>
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
                                        <td>{{ $ResponDetail->kuesioner_detail->jawaban_1 }}</td>
                                        <td style="width: 10%" class="text-center">{{ $ResponDetail->Jawaban_A }}
                                        </td>
                                        <td style="width: 10%" class="text-center">
                                            {{ Round(($ResponDetail->Jawaban_A / $JumlahKategori) * 100, 2) }} %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 5%">B</td>
                                        <td>{{ $ResponDetail->kuesioner_detail->jawaban_2 }}</td>
                                        <td style="width: 10%" class="text-center">{{ $ResponDetail->Jawaban_B }}
                                        </td>
                                        <td style="width: 10%" class="text-center">
                                            {{ Round(($ResponDetail->Jawaban_B / $JumlahKategori) * 100, 2) }} %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 5%">C</td>
                                        <td>{{ $ResponDetail->kuesioner_detail->jawaban_3 }}</td>
                                        <td style="width: 10%" class="text-center">{{ $ResponDetail->Jawaban_C }}
                                        </td>
                                        <td style="width: 10%" class="text-center">
                                            {{ Round(($ResponDetail->Jawaban_C / $JumlahKategori) * 100, 2) }} %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 5%">D</td>
                                        <td>{{ $ResponDetail->kuesioner_detail->jawaban_4 }}</td>
                                        <td style="width: 10%" class="text-center">{{ $ResponDetail->Jawaban_D }}
                                        </td>
                                        <td style="width: 10%" class="text-center">
                                            {{ Round(($ResponDetail->Jawaban_D / $JumlahKategori) * 100, 2) }} %
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 5%">E</td>
                                        <td>{{ $ResponDetail->kuesioner_detail->jawaban_5 }}</td>
                                        <td style="width: 10%" class="text-center">{{ $ResponDetail->Jawaban_E }}
                                        </td>
                                        <td style="width: 10%" class="text-center">
                                            {{ Round(($ResponDetail->Jawaban_E / $JumlahKategori) * 100, 2) }} %
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="grafik" role="tabpanel"
                        aria-labelledby="custom-tabs-one-profile-tab">
                        <div class="table-responsive">
                            <label class="col-form-label-lg">Informasi Survey {{ $data }}</label>
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
                                            <span class="badge badge-info">{{ $data }}</span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 15%">Jumlah Responden</th>
                                        <th style="width: 3%">:</th>
                                        <th><a href="#"
                                                class="btn-sm btn-default bg-fuchsia">{{ $JumlahKategori }}
                                                Orang</a>
                                        </th>
                                    </tr>
                                </thead>
                            </table>

                            <table class=" table table-bordered" width="100%" cellspacing="0">
                                <tr>
                                    <th class="text-center">Grafik Persentase Jawaban {{ $data }}</th>
                                </tr>
                                <tr>
                                    <td class="text-center" id="jawaban_respon"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Grafik Detail Jawaban {{ $data }}</th>
                                </tr>
                                <tr>
                                    <td class="text-center mt-0 mb-0" id="detail_respon"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        var detail = @json($data_jawaban);

        var jawaban_a = @json(Round((($TotalRespon->Jawaban_A / $soal) * 100) / $JumlahKategori, 2));
        var jawaban_b = @json(Round((($TotalRespon->Jawaban_B / $soal) * 100) / $JumlahKategori, 2));
        var jawaban_c = @json(Round((($TotalRespon->Jawaban_C / $soal) * 100) / $JumlahKategori, 2));
        var jawaban_d = @json(Round((($TotalRespon->Jawaban_D / $soal) * 100) / $JumlahKategori, 2));
        var jawaban_e = @json(Round((($TotalRespon->Jawaban_E / $soal) * 100) / $JumlahKategori, 2));

        Highcharts.setOptions({
            colors: Highcharts.map(Highcharts.getOptions().colors, function(color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },

                    stops: [
                        [0, color],
                        [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
            })
        });

        //Persentase Jawaban Respon chart
        Highcharts.chart('jawaban_respon', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    size: '60%',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y} %',
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                name: 'Data',
                data: [{
                        name: 'Jawaban A',
                        y: jawaban_a
                    },
                    {
                        name: 'Jawaban B',
                        y: jawaban_b
                    },
                    {
                        name: 'Jawaban C',
                        y: jawaban_c
                    },
                    {
                        name: 'Jawaban D',
                        y: jawaban_d
                    },
                    {
                        name: 'Jawaban E',
                        y: jawaban_e
                    }
                ]
            }]
        });

        //Detail Jawaban Chart
        const mainContainer = document.getElementById('detail_respon');

        detail.forEach(function(detailEl) {
            const createdDiv = document.createElement('div');
            createdDiv.style.display = 'br';
            // createdDiv.style.width = 100 / detail.length + '%'

            mainContainer.appendChild(createdDiv);

            Highcharts.chart(createdDiv, {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: detailEl.title
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        size: '50%',
                        dataLabels: {
                            enabled: true,
                            // format: '{series.data[0]} <b>{point.data[1]}%</b>'
                            format: '<b>{point.name}</b> : {point.y}',
                        }
                    },
                },
                series: [detailEl]
            });
        });
    </script>
@endsection
