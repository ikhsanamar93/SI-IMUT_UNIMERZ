@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Instrumen Akreditasi')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header ">
                <h3 class="card-title">Kriteria Akreditasi</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('create_akreditasi_master', Crypt::encrypt($data)) }}"
                            class="btn-sm btn-outline-dark">
                            <i class="fa fa-plus"></i> Add Kriteria
                        </a>
                        <a href="{{ route('akreditasi_kategori.index') }}" class="btn-sm btn-outline-danger"><i
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
                                            <a href="{{ route('edit_akreditasi_master', Crypt::encrypt($AkreditasiMaster->id)) }}"
                                                class="btn-sm btn-outline-success">
                                                <i class="fa fa-edit fa-fw"></i>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
