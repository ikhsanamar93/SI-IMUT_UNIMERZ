@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Dokumen Kinerja SPMI')
@section('content')

    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Kinerja SPMI {{ $MonevMasterDokumens->semester }}</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('monev_master_dokumen.show', Crypt::encrypt($MonevMasterDokumens->unit_master_id)) }}"
                            class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Standar SPMI</th>
                                <th class="text-center">Pelaksanaan</th>
                                <th class="text-center">Evaluasi</th>
                                <th class="text-center">Tindak Lanjut</th>
                                <th class="text-center">Pengendalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SpmiStandarMasters as $SpmiStandarMaster)
                                <tr id="hide{{ $SpmiStandarMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $SpmiStandarMaster->no_standar_spmi }}.
                                        <strong>{{ $SpmiStandarMaster->nm_standar_spmi }}</strong>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            <a
                                                href="{{ route('create_monev', [Crypt::encrypt($MonevMasterDokumens->id), $SpmiStandarMaster->id, 'Pelaksanaan']) }}"class="btn-sm btn btn-outline-dark border-0"><i
                                                    class="fa fa-table-columns"></i></a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            <a
                                                href="{{ route('create_monev', [Crypt::encrypt($MonevMasterDokumens->id), $SpmiStandarMaster->id, 'Evaluasi']) }}"class="btn-sm btn btn-outline-danger border-0"><i
                                                    class="fa fa-table-columns"></i></a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            <a
                                                href="{{ route('create_monev', [Crypt::encrypt($MonevMasterDokumens->id), $SpmiStandarMaster->id, 'Tindak Lanjut']) }}"class="btn-sm btn btn-outline-primary border-0"><i
                                                    class="fa fa-table-columns"></i></a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            <a
                                                href="{{ route('create_monev', [Crypt::encrypt($MonevMasterDokumens->id), $SpmiStandarMaster->id, 'Pengendalian']) }}"class="btn-sm btn btn-outline-success border-0"><i
                                                    class="fa fa-table-columns"></i></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
