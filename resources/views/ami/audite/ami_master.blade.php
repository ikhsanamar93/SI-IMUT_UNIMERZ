@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Data Audit SPMI')
@section('content')

    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Audit SPMI</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('ami_master.index') }}" class="btn-sm btn-outline-danger"><i
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
                                <th>Standar SPMI</th>
                                <th class="text-center">Pernyataan</th>
                                <th class="text-center">Observasi</th>
                                <th class="text-center">Temuan</th>
                                <th class="text-center">Audite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AmiPeriodeMasters as $AmiPeriodeMaster)
                                <tr id="hide{{ $AmiPeriodeMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $AmiPeriodeMaster->spmi_standar_master->no_standar_spmi }}.
                                        <strong>{{ $AmiPeriodeMaster->spmi_standar_master->nm_standar_spmi }}</strong>
                                    </td>
                                    <td>
                                        <div class="mt-0 mb-0">
                                            @foreach ($AmiPeriodeMaster->spmi_standar_master->spmi_standar_detail as $DetailStandar)
                                                <p class="mb-0">
                                                    <span class="badge btn btn-outline-dark">{{ $DetailStandar->poin }}
                                                    </span> <span>{!! Str::limit(strip_tags($DetailStandar->pernyataan), $limit = 35, '..') !!}</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            @foreach ($AmiPeriodeMaster->ami_periode_detail as $DetailAmi)
                                                <p class="mb-0">
                                                    @if ($DetailAmi->observasi)
                                                        <a href="{{ route('ami_master.edit', Crypt::encrypt($DetailAmi->id)) }}"
                                                            class="badge btn btn-outline-dark" data-toggle="tooltip"
                                                            title="View/Post">{{ $DetailAmi->spmi_standar_detail->poin }}</a>
                                                    @endif
                                                </p>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            @foreach ($AmiPeriodeMaster->ami_periode_detail as $DetailAmi)
                                                <p class="mb-0">
                                                    @if ($DetailAmi->temuan == 'S')
                                                        <a href="{{ route('ami_master.edit', Crypt::encrypt($DetailAmi->id)) }}"
                                                            class="badge badge-info" data-toggle="tooltip"
                                                            title="View/Post">{{ $DetailAmi->spmi_standar_detail->poin }}-{{ $DetailAmi->temuan }}</a>
                                                    @elseif ($DetailAmi->temuan == 'OB')
                                                        <a href="{{ route('ami_master.edit', Crypt::encrypt($DetailAmi->id)) }}"
                                                            class="badge badge-warning" data-toggle="tooltip"
                                                            title="View/Post">{{ $DetailAmi->spmi_standar_detail->poin }}-{{ $DetailAmi->temuan }}</a>
                                                    @elseif ($DetailAmi->temuan == 'KTsM')
                                                        <a href="{{ route('ami_master.edit', Crypt::encrypt($DetailAmi->id)) }}"
                                                            class="badge badge-danger" data-toggle="tooltip"
                                                            title="View/Post">{{ $DetailAmi->spmi_standar_detail->poin }}-{{ $DetailAmi->temuan }}</a>
                                                    @elseif ($DetailAmi->temuan == 'KTsMi')
                                                        <a href="{{ route('ami_master.edit', Crypt::encrypt($DetailAmi->id)) }}"
                                                            class="badge badge-danger" data-toggle="tooltip"
                                                            title="View/Post">{{ $DetailAmi->spmi_standar_detail->poin }}-{{ $DetailAmi->temuan }}</a>
                                                    @endif
                                                </p>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            @foreach ($AmiPeriodeMaster->ami_periode_detail as $DetailAmi)
                                                <p class="mb-0">
                                                    @if ($DetailAmi->rtk)
                                                        <span
                                                            class="badge btn btn-outline-dark">{{ $DetailAmi->spmi_standar_detail->poin }}</span>
                                                    @endif

                                                </p>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="javascript:void(0)" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#create">
                    <i class="far fa-check-circle"></i></i> Submit one
                </a>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger float-right" data-toggle="modal"
                    data-target="#add">
                    <i class="fa fa-arrows-spin"></i></i> Submit all
                </a>
            </div>
        </div>

        <div class="modal fade" id="create">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Standar SPMI</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-horizontal" action="{{ route('ami_master.store') }}" method="POST"
                        autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="callout callout-danger">
                                <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Sasaran Audit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nm_unit" class="form-control form-control-sm"
                                        placeholder="Nama Unit Kerja"
                                        value="{{ $AmiPeriodes->mutu_periode->siklus }}/{{ $AmiPeriodes->unit_master->nm_unit }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Auditor/Observer</label>
                                <div class="col-sm-6">
                                    <ul>
                                        <li>Auditor 1 : {{ $AmiPeriodes->dosen1->nama }}</li>
                                        <li>Auditor 2 : {{ $AmiPeriodes->dosen2->nama }}</li>
                                        <li>Observer : {{ $AmiPeriodes->dosen3->nama }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Jadwal Audit</label>
                                <div class="col-sm-6">
                                    <div class="input-group date" id="periode_awal" data-target-input="nearest">
                                        <input type="text" name="tgl_periode_ami"
                                            class="form-control form-control-sm datetimepicker-input"
                                            value="{{ $AmiPeriodes->tgl_periode_ami }}" data-target="#periode_awal"
                                            readonly>
                                        <div class="input-group-append" data-target="#periode_awal"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Standar Teraudit *</label>
                                <div class="col-sm-6">
                                    <select name="spmi_standar_master_id"
                                        class="form-control form-control-sm select2 @error('spmi_standar_master_id') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($SpmiStandarMasters as $SpmiStandarMaster)
                                            @if (old('spmi_standar_master_id') == $SpmiStandarMaster->id)
                                                <option value="{{ $SpmiStandarMaster->id }}" selected>
                                                    {{ $SpmiStandarMaster->nm_standar_spmi }}
                                                </option>
                                            @else
                                                <option value="{{ $SpmiStandarMaster->id }}">
                                                    {{ $SpmiStandarMaster->nm_standar_spmi }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('spmi_standar_master_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" class="form-control form-control-sm" name="ami_periode_id"
                                value="{{ $AmiPeriodes->id }}" readonly>
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

        <div class="modal fade" id="add">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Standar SPMI</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-horizontal" action="{{ route('save_ami') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" class="form-control-sm" style="border: 0cm" name="ami_periode"
                                value="{{ $AmiPeriodes->id }}" readonly>
                            <div class="card-body table-responsive p-0" style="height: 560px;">
                                <table class="table table-head-fixed" id="add-all">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th style="display: none;">Periode</th>
                                            <th style="display: none;">ID</th>
                                            <th>Kode</th>
                                            <th>Nama Standar</th>
                                            <th>Kategori Standar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($SpmiStandarMasters as $SpmiStandarMaster)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td style="display: none;"><input type="text" class="form-control-sm"
                                                        style="border: 0cm" name="ami_periode_id[]"
                                                        value="{{ $AmiPeriodes->id }}" readonly></td>
                                                <td style="display: none;"><input type="text" class="form-control-sm"
                                                        style="border: 0cm" name="spmi_standar_master_id[]"
                                                        value="{{ $SpmiStandarMaster->id }}"></td>
                                                <td>{{ $SpmiStandarMaster->no_standar_spmi }}</td>
                                                <td>{{ $SpmiStandarMaster->nm_standar_spmi }}</td>
                                                <td>{{ $SpmiStandarMaster->mutu_kategori->nm_kategori_mutu }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-sm btn-dark" id="simpan_standar">
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
@endsection
@section('js')
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script>
        $('select').select2();

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
