@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Audit Akreditasi')
@section('content')

    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Form Audit Akreditasi</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('akreditasi_asesor') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Instrumen</th>
                                <th>Deskripsi</th>
                                <th>Observasi</th>
                                <th class="text-center">Temuan</th>
                                <th class="text-center">Nilai</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AkreditasiPeriodeDetails as $AkreditasiPeriodeDetail)
                                <tr id="hide{{ $AkreditasiPeriodeDetail->id }}">
                                    <td>{{ $AkreditasiPeriodeDetail->akreditasi_master->no_akreditasi_master }}</td>
                                    <td>{{ $AkreditasiPeriodeDetail->akreditasi_master->monev_kategori->nm_jenis_monev }}
                                    </td>
                                    <td>{!! Str::limit(strip_tags($AkreditasiPeriodeDetail->akreditasi_master->indikator), $limit = 40, '...') !!}</td>
                                    <td>{!! Str::limit(strip_tags($AkreditasiPeriodeDetail->observasi), $limit = 40, '...') !!}</td>
                                    <td class="text-center">
                                        @if ($AkreditasiPeriodeDetail->temuan == 'S')
                                            <span class="badge badge-info">{{ $AkreditasiPeriodeDetail->temuan }}</span>
                                        @elseif ($AkreditasiPeriodeDetail->temuan == 'OB')
                                            <span
                                                class="badge badge-warning">{{ $AkreditasiPeriodeDetail->temuan }}</span>
                                        @elseif ($AkreditasiPeriodeDetail->temuan == 'KTsM')
                                            <span class="badge badge-danger">{{ $AkreditasiPeriodeDetail->temuan }}</span>
                                        @elseif ($AkreditasiPeriodeDetail->temuan == 'KTsMi')
                                            <span class="badge badge-danger">{{ $AkreditasiPeriodeDetail->temuan }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $AkreditasiPeriodeDetail->perolehan_skor }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit_akreditasi_asesor', Crypt::encrypt($AkreditasiPeriodeDetail->id)) }}"
                                            class="btn-sm btn-outline-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
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
