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
                <h3 class="card-title">Hasil Audit Akreditasi</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i> Add Instrumen
                        </a>
                        <a href="{{ route('akreditasi_audite') }}" class="btn-sm btn-outline-danger"><i
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
                                            <span class="badge btn-info">{{ $AkreditasiPeriodeDetail->temuan }}</span>
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
                                    <td class="text-center"><a
                                            href="{{ route('edit_akreditasi_audite', Crypt::encrypt($AkreditasiPeriodeDetail->id)) }}"
                                            class="btn-sm btn-outline-primary">
                                            <i class="fa fa-table-columns"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="add">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Instrumen Akreditasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="{{ route('save_akreditasi_audite') }}" method="POST"
                            autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" class="form-control-sm" style="border: 0cm" name="akreditasi_periode"
                                    value="{{ $AkreditasiPeriodes->id }}" readonly>
                                <div class="card-body table-responsive p-0" style="height: 560px;">
                                    <table class="table table-bordered table-head-fixed" id="add-all">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">Periode</th>
                                                <th style="display: none;">Kategori</th>
                                                <th style="display: none;">ID</th>
                                                <th>Butir</th>
                                                <th>Kategori</th>
                                                <th>Instrumen</th>
                                                <th>Bobot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($AkreditasiMasters as $AkreditasiMaster)
                                                <tr>
                                                    <td style="display: none;"><input type="text" class="form-control-sm"
                                                            style="border: 0cm" name="akreditasi_periode_id[]"
                                                            value="{{ $AkreditasiPeriodes->id }}" readonly></td>
                                                    <td style="display: none;"><input type="text" class="form-control-sm"
                                                            style="border: 0cm" name="akreditasi_kategori_id[]"
                                                            value="{{ $AkreditasiMaster->akreditasi_kategori_id }}"></td>
                                                    <td style="display: none;"><input type="text" class="form-control-sm"
                                                            style="border: 0cm" name="akreditasi_master_id[]"
                                                            value="{{ $AkreditasiMaster->id }}"></td>
                                                    <td>{{ $AkreditasiMaster->no_akreditasi_master }}</td>
                                                    <td>{{ $AkreditasiMaster->akreditasi_kategori->nm_kategori }}</td>
                                                    <td>{{ $AkreditasiMaster->monev_kategori->nm_jenis_monev }}</td>
                                                    <td>{{ $AkreditasiMaster->bobot_penilaian }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-circle-check"></i> Submit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="fa fa-cancel"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
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
