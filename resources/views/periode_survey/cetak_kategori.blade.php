<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Tabel Survey</title>
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
            border-collapse: collapse;
            text-transform: capitalize;
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
        <table class="header" cellspacing="0">
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
        </table><br>
        <table style=" font-size:16px; font-weight: bold" class="no-border" cellspacing="0">
            <tr>
                <th class="no-border" colspan="3" style="text-align: center">
                    <span style="font-size:16px; font-weight:bold; text-transform: uppercase">
                        KUESIONER {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}</span>
                </th>
            </tr>
            <br>
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
                <td class="no-border" style="width: 80%">{{ $data }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 20%">Jumlah Responden</td>
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

        <table width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%; text-align: top">
                        #</th>
                    <th class="text-center">Hasil Rekapitulasi Jawaban
                        Responden</th>
                    <th class="text-center" style="width: 8%">A</th>
                    <th class="text-center" style="width: 8%">B</th>
                    <th class="text-center" style="width: 8%">C</th>
                    <th class="text-center" style="width: 8%">D</th>
                    <th class="text-center" style="width: 8%">E</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ResponDetails as $ResponDetail)
                    <tr>
                        <td style="width: 5%" class="text-center">{{ $loop->iteration }}
                        </td>
                        <td>{!! strip_tags($ResponDetail->kuesioner_detail->pertanyaan) !!}</td>
                        <td class="text-center">{{ $ResponDetail->Jawaban_A }}</td>
                        <td class="text-center">{{ $ResponDetail->Jawaban_B }}</td>
                        <td class="text-center">{{ $ResponDetail->Jawaban_C }}</td>
                        <td class="text-center">{{ $ResponDetail->Jawaban_D }}</td>
                        <td class="text-center">{{ $ResponDetail->Jawaban_E }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th class="text-center">#</th>
                    <th style="text-align: left">Total Responden terhadap
                        {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_A }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_B }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_C }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_D }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_E }}
                    </th>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th style="text-align: left">Rata-rata Responden terhadap
                        {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round($TotalRespon->Jawaban_A / $soal, 2) }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round($TotalRespon->Jawaban_B / $soal, 2) }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round($TotalRespon->Jawaban_C / $soal, 2) }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round($TotalRespon->Jawaban_D / $soal, 2) }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round($TotalRespon->Jawaban_E / $soal, 2) }}
                    </th>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th style="text-align: left">Persentase Responden terhadap
                        {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_A / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_B / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_C / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_D / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_E / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                </tr>
            </tbody>
        </table>
        <p></p>

        <table width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%; text-align: top">
                        #</th>
                    <th class="text-center">Persentase Rekapitulasi Jawaban
                        Responden
                    </th>
                    <th class="text-center" style="width: 8%">A</th>
                    <th class="text-center" style="width: 8%">B</th>
                    <th class="text-center" style="width: 8%">C</th>
                    <th class="text-center" style="width: 8%">D</th>
                    <th class="text-center" style="width: 8%">E</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ResponDetails as $ResponDetail)
                    <tr>
                        <td style="width: 5%" class="text-center">{{ $loop->iteration }}
                        </td>
                        <td>{!! strip_tags($ResponDetail->kuesioner_detail->pertanyaan) !!}</td>
                        <td class="text-center">
                            {{ Round(($ResponDetail->Jawaban_A / $JumlahKategori) * 100, 2) }} %</td>
                        <td class="text-center">
                            {{ Round(($ResponDetail->Jawaban_B / $JumlahKategori) * 100, 2) }} %</td>
                        <td class="text-center">
                            {{ Round(($ResponDetail->Jawaban_C / $JumlahKategori) * 100, 2) }} %</td>
                        <td class="text-center">
                            {{ Round(($ResponDetail->Jawaban_D / $JumlahKategori) * 100, 2) }} %</td>
                        <td class="text-center">
                            {{ Round(($ResponDetail->Jawaban_E / $JumlahKategori) * 100, 2) }} %</td>
                    </tr>
                @endforeach
                <tr>
                    <th class="text-center">#</th>
                    <th style="text-align: left">Total Responden terhadap
                        {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_A }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_B }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_C }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_D }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ $TotalRespon->Jawaban_E }}
                    </th>
                </tr>
                <tr>
                    <th class="text-center">#</th>
                    <th style="text-align: left">Rata-rata Responden terhadap
                        {{ $SurveyPeriodes->kuesioner_master->monev_master->nm_monev }}
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_A / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_B / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_C / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_D / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                    <th class="text-center" style="width: 8%">
                        {{ Round((($TotalRespon->Jawaban_E / $soal) * 100) / $JumlahKategori, 2) }} %
                    </th>
                </tr>
            </tbody>
        </table>
        <p></p>

        <table width="100%" cellspacing="0">
            @foreach ($ResponDetails as $ResponDetail)
                <tr>
                    {{-- <th style="width: 5%" class="text-center">{{ $loop->iteration }}</th> --}}
                    <th style="text-align: left" colspan="4">{{ $loop->iteration }}. {!! strip_tags($ResponDetail->kuesioner_detail->pertanyaan) !!}
                    </th>
                </tr>
                {{-- <tr>
                    <th rowspan="7"></th>
                </tr> --}}
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
    <script>
        // window.addEventListener("load", window.print());
    </script>
</body>

</html>
