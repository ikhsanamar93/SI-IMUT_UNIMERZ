@extends('home.home_layout')
{{-- @section('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">  
@endsection --}}
@section('title', 'SI-IMUT | Dokumen Induk')
@section('body')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><small>Sistem Informasi Penjaminan Mutu</small></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">IJAGO SPMI</a></li>
                            <li class="breadcrumb-item active">v1-Pro</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-outline card-gray-dark">
                            <div class="card-header">
                                <h3 class="card-title">Data Dokumen Induk</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Dokumen Induk</th>
                                                <th>Uraian Dokumen</th>
                                                <th>Kode SPMI</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Link</th>
                                                <th class="text-center">File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($IndukMasterDokumens as $IndukMasterDokumen)
                                                <tr id="hide{{ $IndukMasterDokumen->id }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $IndukMasterDokumen->mutu_dokumen->nm_dokumen_mutu }}</td>
                                                    <td>{{ $IndukMasterDokumen->nm_dokumen_induk }}</td>
                                                    <td>{{ $IndukMasterDokumen->no_dokumen_induk }}</td>
                                                    <td class="text-center">
                                                        @if ($IndukMasterDokumen->status == 1)
                                                            <span class="badge bg-warning">True</span>
                                                        @else
                                                            <span class="badge bg-dark">False</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($IndukMasterDokumen->link_dokumen)
                                                            <a target="_blank" class="btn-sm btn-outline-primary"
                                                                href="{{ $IndukMasterDokumen->link_dokumen }}">
                                                                <i class="far fa-folder-open"></i>
                                                            </a>
                                                        @else
                                                            <span class="badge bg-danger">empty</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($IndukMasterDokumen->file_dokumen)
                                                            <a target="_blank" class="btn-sm btn-outline-primary"
                                                                href="{{ asset('storage/' . $IndukMasterDokumen->file_dokumen) }}">
                                                                <i class="far fa-folder-open"></i>
                                                            </a>
                                                        @else
                                                            <span class="badge bg-danger">empty</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
        $('#dataTable').DataTable();
      });
</script>    
@endsection --}}
