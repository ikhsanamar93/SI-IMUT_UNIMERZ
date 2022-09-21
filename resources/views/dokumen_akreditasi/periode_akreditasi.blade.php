@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('title', 'SI-IMUT | Periode Akreditasi')
@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Periode Akreditasi</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('unit_dokumen_akreditasi') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Kategori</th>
                                <th>Siklus Akreditasi</th>
                                <th>Asesor 1</th>
                                <th>Asesor 2</th>
                                <th class="text-center">Jadwal Audit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AkreditasiPeriodes as $AkreditasiPeriode)
                                <tr id="hide{{ $AkreditasiPeriode->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $AkreditasiPeriode->akreditasi_kategori->nm_kategori }}</td>
                                    <td>{{ $AkreditasiPeriode->mutu_periode->siklus }} /
                                        {{ $AkreditasiPeriode->unit_master->nm_unit }}</td>
                                    <td>{{ $AkreditasiPeriode->dosen1->nama }}</td>
                                    <td>{{ $AkreditasiPeriode->dosen2->nama }}</td>
                                    <td class="text-center">{{ $AkreditasiPeriode->tgl_periode_akreditasi }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{ route('create_dokumen_akreditasi', Crypt::encrypt($AkreditasiPeriode->id)) }}"
                                                class="btn-sm btn-outline-primary" data-toggle="tooltip"
                                                title="View/Post"><i class="fa fa-table-columns"></i>
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
