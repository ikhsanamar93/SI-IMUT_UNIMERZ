@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('title', 'SI-IMUT | Setup AMI Auditor')
@section('content')

    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Periode AMI Auditor</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Siklus</th>
                                <th>Sasaran Audit</th>
                                <th>Auditor 1</th>
                                <th>Auditor 2</th>
                                <th>Observer</th>
                                <th class="text-center">Jadwal Audit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AmiPeriodes as $AmiPeriode)
                                <tr id="hide{{ $AmiPeriode->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $AmiPeriode->mutu_periode->siklus }}</td>
                                    <td>{{ $AmiPeriode->unit_master->nm_unit }}</td>
                                    <td>{{ $AmiPeriode->dosen1->nama }}</td>
                                    <td>{{ $AmiPeriode->dosen2->nama }}</td>
                                    <td>{{ $AmiPeriode->dosen3->nama }}</td>
                                    <td class="text-center">{{ $AmiPeriode->tgl_periode_ami }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{ route('show_ami_detail', Crypt::encrypt($AmiPeriode->id)) }}"
                                                class="btn-sm btn-outline-primary" data-toggle="tooltip"
                                                title="View/Post"><i class="fa fa-table-columns"></i></a>
                                            <a target="_blank"
                                                href="{{ route('ami_periode.show', Crypt::encrypt($AmiPeriode->id)) }}"
                                                class="btn-sm btn-outline-danger" data-toggle="tooltip" title="View/Post"><i
                                                    class="fa fa-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
