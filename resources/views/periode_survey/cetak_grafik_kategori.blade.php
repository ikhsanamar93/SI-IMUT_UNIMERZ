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

        table {
            width: 100%;
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
                <td class="no-border" style="width: 10%">Surveyor</td>
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
                <td class="no-border" style="width: 10%">Jenis Responden</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $data }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 10%">Jumlah Responden</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $JumlahKategori }} Orang</td>
            </tr>
        </table>
        <p></p>

        <table width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%; text-align: top">#</th>
                    <th class="text-center">Informasi Jumlah Responden
                    <th class="text-center" style="width: 30%">Rekap Responden</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Total Responden terhadap
                        {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                    </td>
                    <td class="text-center" style="width: 30%">{{ $JumlahRespon }}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Responden {{ $data }} terhadap
                        {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                    </td>
                    <td class="text-center" style="width: 30%">{{ $JumlahKategori }}
                    </td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Persentase Responden {{ $data }} terhadap
                        {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                    </td>
                    <td class="text-center" style="width: 30%">
                        {{ Round($persentase['kategori'], 2) }} %
                    </td>
                </tr>
            </tbody>
        </table>
        <p></p>
        <div style="width: 100%; height: 50%; align-items: center;" id="jawaban_respon"></div>
        <div id="detail_respon"></div>
    </div>
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
            // createdDiv.style.display = 'br';
            // createdDiv.style.width = '100%';

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
