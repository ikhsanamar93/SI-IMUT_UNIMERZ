@extends('home.home_layout')
{{-- @section('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">  
@endsection --}}
@section('title', 'SI-IMUT | Standar SPMI')
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
                            <div class="card-header ">
                                <h3 class="card-title"> Standar SPMI </h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Kategori Standar</th>
                                                <th>Nama Standar</th>
                                                <th>Kode Standar</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($SpmiStandarMasters as $SpmiStandarMaster)
                                                <tr id="hide{{ $SpmiStandarMaster->id }}" data-widget="expandable-table"
                                                    aria-expanded="true">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $SpmiStandarMaster->mutu_kategori->nm_kategori_mutu }}</td>
                                                    <td>{{ $SpmiStandarMaster->nm_standar_spmi }}</td>
                                                    <td>{{ $SpmiStandarMaster->no_standar_spmi }}</td>
                                                    <td class="text-center">
                                                        @if ($SpmiStandarMaster->status_spmi == 1)
                                                            <span class="badge bg-warning">True</span>
                                                        @else
                                                            <span class="badge bg-dark">False</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr class="expandable-body">
                                                    <td colspan="7">
                                                        <div class="mt-0 mb-0">
                                                            <table class="table-responsive table-sm" width="100%"
                                                                cellspacing="0">
                                                                <tbody>
                                                                    <tr class="mb-0">
                                                                        @foreach ($SpmiStandarMaster->spmi_standar_detail as $SpmiStandarMaster)
                                                                            <td class="mb-0">
                                                                                <a class="badge btn-sm btn-info"
                                                                                    href="{{ route('pernyataan_spmi', Crypt::encrypt($SpmiStandarMaster->id)) }}">{{ $SpmiStandarMaster->poin }}</a>
                                                                                <span class="badge">isi
                                                                                    Standar</span>
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                </tbody>
                                                            </table>
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
