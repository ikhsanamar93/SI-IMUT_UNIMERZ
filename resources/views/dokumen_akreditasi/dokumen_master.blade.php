@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('title', 'SI-IMUT | Dokumen Akreditasi')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header ">
                <h3 class="card-title">{{ $AkreditasiPeriodes->unit_master->nm_unit }}</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('show_dokumen_akreditasi', Crypt::encrypt($AkreditasiPeriodes->unit_master_id)) }}"
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
                                <th>Instrumen</th>
                                <th>Kriteria Akreditasi</th>
                                <th>Butir</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Dok.</th>
                                <th class="text-center">Bobot</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AkreditasiMasters as $AkreditasiMaster)
                                <tr id="hide{{ $AkreditasiMaster->id }}" data-widget="expandable-table"
                                    aria-expanded="false">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $AkreditasiMaster->akreditasi_kategori->nm_kategori }}</td>
                                    <td>{{ $AkreditasiMaster->monev_kategori->nm_jenis_monev }}</td>
                                    <td>{{ $AkreditasiMaster->no_akreditasi_master }}</td>
                                    <td>{{ Str::limit(strip_tags($AkreditasiMaster->indikator), $limit = 40, '...') }}
                                    </td>
                                    <td class="text-center">{{ $AkreditasiMaster->jenis_dokumen }}</td>
                                    <td class="text-center">{{ $AkreditasiMaster->bobot_penilaian }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{ route('add_dokumen_akreditasi', [Crypt::encrypt($AkreditasiMaster->id), $AkreditasiPeriodes->id]) }}"
                                                class="btn-sm btn-outline-primary">
                                                <i class="fa fa-table-columns"></i>
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
