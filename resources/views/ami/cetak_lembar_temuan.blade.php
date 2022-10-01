<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak AMI SPMI</title>
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
                    <span style="font-size:30px; font-weight:bold;">
                        UNIVERSITAS MEGAREZKY</span> <br>
                    <span style="font-size:17px;">
                        SK. Menristekdikti RI. No.1194/KPT/I/2018 Terakreditasi BAN PT</span> <br>
                </td>
                <td class="no-border" style="width: 8%" rowspan="2"></td>
            </tr>
            <tr>
                <td class="no-border" style="line-height: 1; text-align: center">
                    <span class="text-" style="font-size:15px;"">
                        <i>Alamat : Kampus JI. Antang Raya No. 43 Telp 0411-492401 / 496401 Fax 496614 <br>
                            Website: https://www.universitasmegarezky.ac.id/ <br>
                            Email : info@universitasmegarezkv.ac.id
                        </i></span>
                </td>
            </tr>
        </table>
        <table style=" font-size:16px; font-weight: bold" class="no-border" cellspacing="0">
            <tr>
                <th class="no-border" colspan="3" style="text-align: center">

                    <span style="font-size:16px; font-weight:bold;">
                        LAPORAN AUDIT MUTU INTERNAL</span> <br>
                    <span style="font-size:18px; font-weight:bold;">
                        OBSERVASI DAN TEMUAN AUDITOR</span> <br>
                </th>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Unit</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->unit_master->nm_unit }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Siklus</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->mutu_periode->siklus }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Auditee</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->dosen->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Asesor 1</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->dosen1->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Asesor 2</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->dosen2->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Observer</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->dosen3->nama }}</td>
            </tr>
        </table>
        <table style="font-size:14px; cellspacing=" 0">
            @foreach ($AmiPeriodeMasters as $AmiPeriodeMaster)
                <tr>
                    <td colspan="5">
                        <P>
                            {{ $AmiPeriodeMaster->spmi_standar_master->no_standar_spmi }}.
                            <strong>{{ $AmiPeriodeMaster->spmi_standar_master->nm_standar_spmi }}</strong>
                        </P>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center; width: 2%">No.</th>
                    <th style="text-align: center; width: 25%">Pernyataan Standar</th>
                    <th style="text-align: center; width: 25%">Observasi Auditor</th>
                    <th style="text-align: center; width: 25%">Temuan dan Deskripsi</th>
                    <th style="text-align: center; width: 20%">Akar Masalah</th>
                </tr>
                @foreach ($AmiPeriodeMaster->ami_periode_detail as $DetailAmi)
                    <tr>
                        <td style="text-align: center; width: 2%">{{ $DetailAmi->spmi_standar_detail->poin }}</td>
                        <td style="width: 25%"><span>{!! $DetailAmi->spmi_standar_detail->pernyataan !!}</span></td>
                        <td style="width: 25%">{!! $DetailAmi->observasi !!}</td>
                        <td style="width: 25%">Temuan Audit :
                            <strong>{{ $DetailAmi->temuan }}</strong><br>{!! $DetailAmi->uraian_temuan !!}
                        </td>
                        <td style="width: 20%">{!! $DetailAmi->akar_masalah !!}</td>
                    </tr>
                @endforeach
            @endforeach
        </table>

        <div>
            <br />
        </div>

        <table class="header" cellspacing="0">
            <tr>
                {{-- <td class="no-border" style="width: 8%; text-align: center" rowspan="2"><img
                        src="{{ asset('image/app/logo.png') }}" width="90px">
                </td> --}}
                <td class="no-border" style="width: 8%; text-align: center" rowspan="2">

                </td>
                <td class="no-border" style="text-align: center;">
                    <span style="font-size:30px; font-weight:bold;">
                        UNIVERSITAS MEGAREZKY</span> <br>
                    <span style="font-size:17px;">
                        SK. Menristekdikti RI. No.1194/KPT/I/2018 Terakreditasi BAN PT</span> <br>
                </td>
                <td class="no-border" style="width: 8%" rowspan="2"></td>
            </tr>
            <tr>
                <td class="no-border" style="line-height: 1; text-align: center">
                    <span class="text-" style="font-size:15px;"">
                        <i>Alamat : Kampus JI. Antang Raya No. 43 Telp 0411-492401 / 496401 Fax 496614 <br>
                            Website: https://www.universitasmegarezky.ac.id/ <br>
                            Email : info@universitasmegarezkv.ac.id
                        </i></span>
                </td>
            </tr>
        </table>
        <table class="no-border" style="font-size:16px; font-weight: bold" cellspacing="0">
            <tr>
                <th class="no-border" colspan="3" style="text-align: center">
                    <span style="font-size:16px; font-weight:bold;">
                        LAPORAN AUDIT MUTU INTERNAL</span> <br>
                    <span style="font-size:18px; font-weight:bold;">
                        REKOMENDASI DAN TINDAKAN KOREKSI</span> <br>
                </th>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Unit</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->unit_master->nm_unit }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Siklus</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->mutu_periode->siklus }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Auditee</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->dosen->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Auditor 1</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->dosen1->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Auditor 2</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->dosen2->nama }}</td>
            </tr>
            <tr>
                <td class="no-border" style="width: 7%">Observer</td>
                <td class="no-border" style="width: 1%">:</td>
                <td class="no-border" style="width: 80%">{{ $AmiPeriodes->dosen3->nama }}</td>
            </tr>
        </table>
        <table style="font-size: 14px" cellspacing="0">
            @foreach ($AmiPeriodeMasters as $AmiPeriodeMaster)
                <tr>
                    <td colspan="5">
                        <P>
                            {{ $AmiPeriodeMaster->spmi_standar_master->no_standar_spmi }}.
                            <strong>{{ $AmiPeriodeMaster->spmi_standar_master->nm_standar_spmi }}</strong>
                        </P>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center; width: 2%">No.</th>
                    <th style="text-align: center; width: 25%">Pernyataan Standar</th>
                    <th style="text-align: center; width: 25%">Peluang Peningkatan</th>
                    <th style="text-align: center; width: 25%">Rekomendasi</th>
                    <th style="text-align: center; width: 20%">Rencana Tindakan Koreksi</th>
                </tr>
                @foreach ($AmiPeriodeMaster->ami_periode_detail as $DetailAmi)
                    <tr>
                        <td style="text-align: center; width: 2%">{{ $DetailAmi->spmi_standar_detail->poin }}</td>
                        <td style="width: 25%"><span>{!! $DetailAmi->spmi_standar_detail->pernyataan !!}</span></td>
                        <td style="width: 25%">{!! $DetailAmi->peluang_peningkatan !!}</td>
                        <td style="width: 25%">Temuan Audit :
                            <strong>{{ $DetailAmi->temuan }}</strong><br>{!! $DetailAmi->rekomendasi !!}
                        </td>
                        <td style="width: 20%">{!! $DetailAmi->rtk !!}</td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    </div>
    <script>
        // window.addEventListener("load", window.print());
    </script>
</body>

</html>
