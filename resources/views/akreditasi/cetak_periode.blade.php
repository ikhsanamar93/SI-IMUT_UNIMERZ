<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Audit Akreditasi</title>
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

        #blank {

            border: none;
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
        <table class="header" cellspacing="0">
            <tr>
                {{-- <td class="no-border" style="width: 8%; text-align: center" rowspan="2"><img
                        src="{{ asset('image/app/logo.png') }}" width="90px">
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
        <br>
        <table class="no-border" width=" 100%" cellspacing="0">
            <tr>
                <th class="no-border" style="text-align: center">
                    <span style="font-size:18px; font-weight:bold;">
                        LAPORAN AUDIT AKREDITASI</span> <br>
                </th>
            </tr>
        </table>
        <table class="no-border" style="font-size:16px; font-weight: bold" width="100%" cellspacing="0">
            <tr>
                <td class="no-border" style="width: 7%">Unit</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AkreditasiPeriodes->unit_master->nm_unit }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Siklus</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AkreditasiPeriodes->mutu_periode->siklus }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Auditee</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AkreditasiPeriodes->dosen->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Asesor 1</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AkreditasiPeriodes->dosen1->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Asesor 2</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AkreditasiPeriodes->dosen2->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Perolehan</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $nilai }}</td>
            </tr>
        </table>
        <table style="font-size:14px; border: 1px solid black;" width=" 100%" cellspacing="0">
            <tr>
                <th style="width: 3%; border-bottom: 1px solid black; text-align: center">No.</th>
                <th
                    style="width: 45%; border-bottom: 1px solid black; border-left: 1px solid black; text-align: center">
                    KRITERIA/DESKRIPSI</th>
                <th
                    style="width: 45%; border-bottom: 1px solid black; border-left: 1px solid black; text-align: center">
                    OBSERVASI ASESOR</th>
                <th style="width: 7%; border-bottom: 1px solid black; border-left: 1px solid black; text-align: center">
                    NILAI
                </th>
            </tr>
            @foreach ($AkreditasiPeriodeDetails as $AkreditasiPeriodeDetail)
                <tr>
                    <td style="width: 3%; border-bottom: 1px solid black; text-align: center;">
                        {{ $loop->iteration }}</td>
                    <td style="width: 45%; border-bottom: 1px solid black; border-left: 1px solid black;">
                        <strong>{{ $AkreditasiPeriodeDetail->akreditasi_master->no_akreditasi_master }}.
                            {{ $AkreditasiPeriodeDetail->akreditasi_master->monev_kategori->nm_jenis_monev }}.</strong>
                        {!! $AkreditasiPeriodeDetail->akreditasi_master->indikator !!}
                    </td>
                    <td style="width: 45%; border-bottom: 1px solid black; border-left: 1px solid black;">
                        {!! $AkreditasiPeriodeDetail->observasi !!}</td>
                    <td
                        style="width: 7%; border-bottom: 1px solid black; border-left: 1px solid black; text-align: center">
                        {{ $AkreditasiPeriodeDetail->temuan }}<br>{{ $AkreditasiPeriodeDetail->perolehan_skor }}
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
