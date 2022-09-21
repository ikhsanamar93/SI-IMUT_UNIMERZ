<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Grafik Survey</title>
    <style>
        table,
        th,
        td {
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left: 5px;
            padding-right: 5px;
        }

        body {
            margin-top: 20px;
            margin-left: 20px;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .text-center {
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid #000000;
            border-collapse: collapse
        }

        .header {
            border-top: 0px solid white;
            border-left: none;
            border-right: none;
            border-bottom: 3px solid black;
        }

        .no-border {
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="col-md-12">
        <table class="header" width="100%" cellspacing="0">
            <tr>
                {{-- <td class="no-border" style="width: 8%; text-align: center" rowspan="2"><img src="{{ asset('image/app/logo.png') }}"
                            width="90px">
                    </td> --}}
                <td class="no-border" style="width: 8%; text-align: center" rowspan="2"></td>
                <td class="no-border" style="text-align: center;">
                    <span style="font-size:20px; font-weight:bold;">
                        YAYASAN PELITA MAS PALU</span> <br>
                    <span style="font-size:25px; font-weight:bold;">
                        SEKOLAH TINGGI ILMU FARMASI</span> <br>
                    <span class="text-uppercase" style="font-size:25px; font-weight:bold;">
                        PELITA MAS PALU
                    </span>
                </td>
                <td class="no-border" style="width: 8%" rowspan="2"></td>
            </tr>
            <tr>
                <td class="no-border" style="line-height: 1; text-align: center">
                    <span class="text-" style="font-size:13px;"">
                        <i>Alamat Kampus: Jl. Wolter Monginsidi No. 106 A Telp/Fax. (0451)458681 Palu -
                            Sulawesi Tengah <br> Email: stifapelitamaspalu@yahoo.co.id Website:
                            www.stifapelitamas.ac.id
                        </i></span>
                </td>
            </tr>
        </table>
        <p></p>
        <table style=" font-size:16px; font-weight: bold" class="no-border" cellspacing="0">
            <tr>
                <th class="no-border" colspan="3" style="text-align: center">
                    <P></P>
                    <span style="font-size:16px; font-weight:bold; text-transform: uppercase">
                        KUESIONER {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}</span>
                    <p></p>
                </th>
            </tr>
            <tr>
                <td class="no-border" style="width: 20%">Surveyor</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $SurveyPeriodes->unit_master->nm_unit }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 5%">Siklus</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $SurveyPeriodes->mutu_periode->siklus }} /
                    {{ $SurveyPeriodes->semester }}
                </td>
            </tr>
            <tr>
                <td class="no-border" style="width: 20%">Jenis Responden</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">
                    @if ($SurveyPeriodes->responden_mahasiswa == 1)
                        <span>Mahasiswa, </span>
                    @endif
                    @if ($SurveyPeriodes->responden_dosen == 1)
                        <span>Dosen, </span>
                    @endif
                    @if ($SurveyPeriodes->responden_tendik == 1)
                        <span>Tendik, </span>
                    @endif
                    @if ($SurveyPeriodes->responden_alumni == 1)
                        <span>Alumni, </span>
                    @endif
                    @if ($SurveyPeriodes->responden_mitra == 1)
                        <span>Stakeholder</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="no-border" style="width: 20%">Jumlah Responden</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $JumlahRespon }} Orang</td>
            </tr>
        </table>
        <p></p>

        <div id="jumlah_respon"></div>
        <div id="jawaban_respon"></div>
        <div id="detail_respon"></div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        var detail = @json($data);

        var mahasiswa = @json(round($persentase['mahasiswa'], 2));
        var dosen = @json(round($persentase['dosen'], 2));
        var tendik = @json(round($persentase['tendik'], 2));
        var alumni = @json(round($persentase['alumni'], 2));
        var mitra = @json(round($persentase['mitra'], 2));

        var jawaban_a = @json(Round(($TotalRespon->Jawaban_A / $soal) * 100) / $JumlahRespon, 2);
        var jawaban_b = @json(Round(($TotalRespon->Jawaban_B / $soal) * 100) / $JumlahRespon, 2);
        var jawaban_c = @json(Round(($TotalRespon->Jawaban_C / $soal) * 100) / $JumlahRespon, 2);
        var jawaban_d = @json(Round(($TotalRespon->Jawaban_D / $soal) * 100) / $JumlahRespon, 2);
        var jawaban_e = @json(Round(($TotalRespon->Jawaban_E / $soal) * 100) / $JumlahRespon, 2);

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

        // Jumlah Respon chart
        Highcharts.chart('jumlah_respon', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Grafik Persentase Jumlah Responden'
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
                        name: 'Mahasiswa',
                        y: mahasiswa
                    },
                    {
                        name: 'Dosen',
                        y: dosen
                    },
                    {
                        name: 'Tendik',
                        y: tendik
                    },
                    {
                        name: 'Alumni',
                        y: alumni
                    },
                    {
                        name: 'Stakeholder',
                        y: mitra
                    }
                ]
            }]
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
                text: 'Grafik Persentase Jawaban Responden'
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
                            format: '<b>{point.name}</b> : {point.y}',
                        }
                    },
                },
                series: [detailEl]
            });
        });
    </script>
    <script>
        // window.addEventListener("load", window.print());
    </script>
</body>

</html>
