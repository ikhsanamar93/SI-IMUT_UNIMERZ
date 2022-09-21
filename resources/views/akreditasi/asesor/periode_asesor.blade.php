@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('title', 'SI-IMUT | Akreditasi Asesor')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Akreditasi Asesor</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Kategori</th>
                                <th class="text-center">Siklus</th>
                                <th>Akreditasi</th>
                                <th>Asesor 1</th>
                                <th>Asesor 2</th>
                                <th class="text-center">Jadwal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AkreditasiPeriodes as $AkreditasiPeriode)
                                <tr id="hide{{ $AkreditasiPeriode->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $AkreditasiPeriode->akreditasi_kategori->nm_kategori }}</td>
                                    <td class="text-center">{{ $AkreditasiPeriode->mutu_periode->siklus }}</td>
                                    <td>{{ $AkreditasiPeriode->unit_master->nm_unit }}</td>
                                    <td>{{ $AkreditasiPeriode->dosen1->nama }}</td>
                                    <td>{{ $AkreditasiPeriode->dosen2->nama }}</td>
                                    <td class="text-center">{{ $AkreditasiPeriode->tgl_periode_akreditasi }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{ route('show_akreditasi_asesor', Crypt::encrypt($AkreditasiPeriode->id)) }}"
                                                class="btn-sm btn-outline-primary" data-toggle="tooltip"
                                                title="View/Post"><i class="fa fa-table-columns"></i></a>
                                            <a target="_blank"
                                                href="{{ route('create_akreditasi_periode', Crypt::encrypt($AkreditasiPeriode->id)) }}"
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
