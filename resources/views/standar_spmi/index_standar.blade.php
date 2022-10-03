@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('title', 'SI-IMUT | Standar SPMI')
@section('content')
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Unit Institusi/Lembaga</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Unit Kerja</th>
                                <th>Kode Unit</th>
                                {{-- <th>SK Penetapan</th> --}}
                                {{-- <th class="text-center">Tgl. Penetapan</th> --}}
                                <th>Unit Pengelola</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($UnitMasters as $UnitMaster)
                                <tr id="hide{{ $UnitMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><b>{{ $UnitMaster->nm_unit }}</b></td>
                                    <td>{{ $UnitMaster->no_unit }}</td>
                                    {{-- <td>{{ $UnitMaster->no_penetapan_unit }}</td> --}}
                                    {{-- <td class="text-center">{{ $UnitMaster->tgl_penetapan_unit }}</td> --}}
                                    <td>{{ $UnitMaster->unit_pengelola->nm_unit_pengelola }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('standar_master.show', Crypt::encrypt($UnitMaster->id)) }}"
                                            class="btn-sm btn-outline-primary" data-toggle="tooltip" title="View/Post"><i
                                                class="fa fa-table-columns"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Unit Program Studi</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Unit Kerja</th>
                                <th>Kode Unit</th>
                                {{-- <th>SK Penetapan</th> --}}
                                {{-- <th class="text-center">Tgl. Penetapan</th> --}}
                                <th>Unit Pengelola</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($UnitMasters1 as $UnitMaster1)
                                <tr id="hide{{ $UnitMaster1->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><b>{{ $UnitMaster1->nm_unit }}</b></td>
                                    <td>{{ $UnitMaster1->no_unit }}</td>
                                    {{-- <td>{{ $UnitMaster1->no_penetapan_unit }}</td> --}}
                                    {{-- <td class="text-center">{{ $UnitMaster1->tgl_penetapan_unit }}</td> --}}
                                    <td>{{ $UnitMaster1->unit_pengelola->nm_unit_pengelola }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('standar_master.show', Crypt::encrypt($UnitMaster1->id)) }}"
                                            class="btn-sm btn-outline-primary" data-toggle="tooltip" title="View/Post"><i
                                                class="fa fa-table-columns"></i></a>
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

        $(document).ready(function() {
            $('#dataTable1').DataTable();
        });
    </script>
@endsection
