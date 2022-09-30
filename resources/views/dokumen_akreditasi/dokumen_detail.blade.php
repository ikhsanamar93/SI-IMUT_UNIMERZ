@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('title', 'SI-IMUT | Form Dokumen Akreditasi')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Dokumen Akreditasi</h3>
                <div class="card-tools">
                    <a href="{{ route('create_dokumen_akreditasi', Crypt::encrypt($AkreditasiPeriode->id)) }}"
                        class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
            </div>


            <div class="card-body">
                <div class="form-group mb-0">
                    <div class="table-responsive">
                        <table class="table text-nowrap" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Unit Kerja</th>
                                    <th style="width: 2%">:</th>
                                    <th>{{ $AkreditasiPeriode->unit_master->nm_unit }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Siklus</th>
                                    <th style="width: 2%">:</th>
                                    <th>{{ $AkreditasiPeriode->mutu_periode->siklus }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Instrumen Akreditasi</th>
                                    <th style="width: 2%">:</th>
                                    <th>{{ $AkreditasiMaster->no_akreditasi_master }}.
                                        {{ $AkreditasiMaster->monev_kategori->nm_jenis_monev }}
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Dok./Bobot</th>
                                    <th style="width: 2%">:</th>
                                    <th>{{ $AkreditasiMaster->jenis_dokumen }} /
                                        {{ $AkreditasiMaster->bobot_penilaian }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="form-group mb-0 mt-0">
                    <label class="col-form-label-lg mb-0">Deskripsi Kriteria</label>
                    <br><Span>{!! $AkreditasiMaster->indikator !!}</Span>
                </div>
                <div class="form-group mb-0 mt-0">
                    <label class="col-form-label-lg mb-0">Indikator Kinerja</label>
                    <br><span>{!! $AkreditasiMaster->indikator_4 !!}</span>
                </div>
                <div class="form-group mb-0 mt-0">
                    <label class="col-form-label-lg mb-0">Dokumen Terkait</label>
                    <br><Span>{!! $AkreditasiMaster->dokumen_terkait !!}</Span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-dark card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#induk"
                            role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Dok. Induk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#tahunan"
                            role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Dok. Mutu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#kinerja"
                            role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Dok. Kinerja</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="induk" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">
                        <div class="form-group-sm row">
                            <div class="col-sm-4">
                                <select name="mutu_dokumen_id" id="mutu_dokumen_id"
                                    class="form-control form-control-sm select2 @error('mutu_dokumen_id') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    @foreach ($IndukDokumens as $IndukDokumen)
                                        @if (old('mutu_dokumen_id') == $IndukDokumen->id)
                                            <option value="{{ $IndukDokumen->id }}" selected>
                                                {{ $IndukDokumen->nm_dokumen_mutu }}</option>
                                        @else
                                            <option value="{{ $IndukDokumen->id }}">
                                                {{ $IndukDokumen->nm_dokumen_mutu }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" class="form-control form-control-sm col-sm-1" name="akreditasi_periode_id"
                                id="akreditasi_periode_id" value="{{ $AkreditasiPeriode->id }}" readonly>
                            <input type="hidden" class="form-control form-control-sm col-sm-1" name="unit_master_id"
                                id="unit_master_id" value="{{ $AkreditasiPeriode->unit_master_id }}" readonly>
                            <input type="hidden" class="form-control form-control-sm col-sm-1" name="kategori"
                                id="kategori" value="1" readonly>
                            <button type="button" id="btn_induk" class="btn btn-sm btn-warning"><i
                                    class="fa fa-file-edit"></i> Add
                                New</button>
                        </div>
                        <p></p>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th>Dokumen</th>
                                        <th>Uraian Dokumen</th>
                                        <th class="text-center" style="width: 10%">Link</th>
                                        <th class="text-center" style="width: 10%">File</th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($DokInduks as $DokInduk)
                                        <tr id="hide{{ $DokInduk->id }}" data-widget="expandable-table"
                                            aria-expanded="false">
                                            <td class="text-center" style="width: 5%">{{ $loop->iteration }}</td>
                                            <td>{{ $DokInduk->induk_master_dokumen->mutu_dokumen->nm_dokumen_mutu }}
                                            </td>
                                            <td>{{ $DokInduk->induk_master_dokumen->nm_dokumen_induk }}</td>
                                            <td class="text-center" style="width: 10%">
                                                @if ($DokInduk->induk_master_dokumen->link_dokumen)
                                                    <a target="_blank" class="btn-sm btn-outline-primary"
                                                        href="{{ $DokInduk->induk_master_dokumen->link_dokumen }}">
                                                        <i class="far fa-folder-open"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">empty</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width: 10%">
                                                @if ($DokInduk->induk_master_dokumen->file_dokumen)
                                                    <a target="_blank" class="btn-sm btn-outline-primary"
                                                        href="{{ asset('storage/' . $DokInduk->induk_master_dokumen->file_dokumen) }}">
                                                        <i class="far fa-folder-open"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">empty</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width: 5%">
                                                <form action="{{ route('delete_dokumen_akreditasi', $DokInduk->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('Delete')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger border-0 btn_delete"><i
                                                            class="far fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tahunan" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">
                        <div class="form-group-sm row">
                            <div class="col-sm-4">
                                <select name="mutu_dokumen_id_mt" id="mutu_dokumen_id_mt"
                                    class="form-control form-control-sm select2 @error('mutu_dokumen_id_mt') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    @foreach ($KinerjaDokumens as $KinerjaDokumen)
                                        @if (old('mutu_dokumen_id_mt') == $KinerjaDokumen->id)
                                            <option value="{{ $KinerjaDokumen->id }}" selected>
                                                {{ $KinerjaDokumen->nm_dokumen_mutu }}</option>
                                        @else
                                            <option value="{{ $KinerjaDokumen->id }}">
                                                {{ $KinerjaDokumen->nm_dokumen_mutu }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" class="form-control form-control-sm col-sm-1" name="mutu_periode_id"
                                id="mutu_periode_id" value="{{ $AkreditasiPeriode->mutu_periode_id }}" readonly>
                            <input type="hidden" class="form-control form-control-sm col-sm-1" name="kategori_mt"
                                id="kategori_mt" value="2" readonly>
                            <button type="button" id="btn_mutu" class="btn btn-sm btn-warning"><i
                                    class="fa fa-file-edit"></i> Add
                                New</button>
                        </div>
                        <p></p>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th>Dokumen</th>
                                        <th>Uraian Dokumen</th>
                                        <th class="text-center" style="width: 10%">Link</th>
                                        <th class="text-center" style="width: 10%">File</th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($DokMutus as $DokMutu)
                                        <tr id="hide{{ $DokMutu->id }}" data-widget="expandable-table"
                                            aria-expanded="false">
                                            <td class="text-center" style="width: 5%">{{ $loop->iteration }}</td>
                                            <td>{{ $DokMutu->mutu_detail_dokumen->mutu_dokumen->nm_dokumen_mutu }}
                                            </td>
                                            <td>{{ $DokMutu->mutu_detail_dokumen->nm_detail_dokumen_mutu }}</td>
                                            <td class="text-center" style="width: 10%">
                                                @if ($DokMutu->mutu_detail_dokumen->link_dokumen)
                                                    <a target="_blank" class="btn-sm btn-outline-primary"
                                                        href="{{ $DokMutu->mutu_detail_dokumen->link_dokumen }}">
                                                        <i class="far fa-folder-open"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">empty</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width: 10%">
                                                @if ($DokMutu->mutu_detail_dokumen->file_dokumen)
                                                    <a target="_blank" class="btn-sm btn-outline-primary"
                                                        href="{{ asset('storage/' . $DokMutu->mutu_detail_dokumen->file_dokumen) }}">
                                                        <i class="far fa-folder-open"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">empty</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width: 5%">
                                                <form action="{{ route('delete_dokumen_akreditasi', $DokMutu->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('Delete')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger border-0 btn_delete"><i
                                                            class="far fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="kinerja" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">
                        <div class="form-group-sm row">
                            <div class="col-sm-4">
                                <select name="mutu_dokumen_id_mv" id="mutu_dokumen_id_mv"
                                    class="form-control form-control-sm select2 @error('mutu_dokumen_id_mv') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    @foreach ($KinerjaDokumens as $KinerjaDokumen)
                                        @if (old('mutu_dokumen_id_mv') == $KinerjaDokumen->id)
                                            <option value="{{ $KinerjaDokumen->id }}" selected>
                                                {{ $KinerjaDokumen->nm_dokumen_mutu }}</option>
                                        @else
                                            <option value="{{ $KinerjaDokumen->id }}">
                                                {{ $KinerjaDokumen->nm_dokumen_mutu }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select name="jenis_kinerja" id="jenis_kinerja"
                                    class="form-control form-control-sm col-md-2 select2 @error('jenis_kinerja') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    <option value="Pelaksanaan">Pelaksanaan</option>
                                    <option value="Evaluasi">Evaluasi</option>
                                    <option value="Tindak Lanjut">Tindak Lanjut</option>
                                    <option value="Pengendalian">Pengendalian</option>
                                </select>
                            </div>
                            <input type="hidden" class="form-control form-control-sm col-sm-1" name="kategori_mv"
                                id="kategori_mv" value="3" readonly>
                            <button type="button" id="btn_monev" class="btn btn-sm btn-warning"><i
                                    class="fa fa-file-edit"></i> Add
                                New</button>
                        </div>
                        <p></p>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_kinerja" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%">#</th>
                                        <th style="width: 10%">Kategori</th>
                                        <th style="width: 35%">Dokumen</th>
                                        <th>Uraian Dokumen</th>
                                        <th class="text-center" style="width: 10%">Link</th>
                                        <th class="text-center" style="width: 10%">File</th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($DokMonevs as $DokMonev)
                                        <tr id="hide{{ $DokMonev->id }}" data-widget="expandable-table"
                                            aria-expanded="false">
                                            <td class="text-center" style="width: 5%">{{ $loop->iteration }}</td>
                                            <td style="width: 10%">
                                                {{ $DokMonev->monev_detail_dokumen->kinerja_kategori }}</td>
                                            <td style="width: 35%">
                                                {{ $DokMonev->monev_detail_dokumen->mutu_dokumen->nm_dokumen_mutu }}
                                            </td>
                                            <td>{{ $DokMonev->monev_detail_dokumen->nm_dokumen_monev }}</td>
                                            <td class="text-center" style="width: 10%">
                                                @if ($DokMonev->monev_detail_dokumen->link_dokumen)
                                                    <a target="_blank" class="btn-sm btn-outline-primary"
                                                        href="{{ $DokMonev->monev_detail_dokumen->link_dokumen }}">
                                                        <i class="far fa-folder-open"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">empty</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width: 10%">
                                                @if ($DokMonev->monev_detail_dokumen->file_dokumen)
                                                    <a target="_blank" class="btn-sm btn-outline-primary"
                                                        href="{{ asset('storage/' . $DokMonev->monev_detail_dokumen->file_dokumen) }}">
                                                        <i class="far fa-folder-open"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">empty</span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width: 5%">
                                                <form action="{{ route('delete_dokumen_akreditasi', $DokMonev->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('Delete')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger border-0 btn_delete"><i
                                                            class="far fa-trash-can"></i></button>
                                                </form>
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

    <div class="modal fade" id="add_dok_induk">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dokumen Induk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('save_dokumen_akreditasi') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="akreditasi_periode_id" value="{{ $AkreditasiPeriode->id }}"
                            readonly>
                        <input type="hidden" name="akreditasi_master_id" value="{{ $AkreditasiMaster->id }}" readonly>
                        <input type="hidden" name="unit_master_id" value="{{ $AkreditasiPeriode->unit_master_id }}"
                            readonly>
                        <input type="hidden" name="mutu_periode_id" value="{{ $AkreditasiPeriode->mutu_periode_id }}"
                            readonly>
                        <input type="hidden" name="dokumen_kategori" value="1" readonly>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                                <thead>
                                    <th class="text-center" style="width: 5%"></th>
                                    <th style="width: 35%">Dokumen Induk</th>
                                    <th>Uraian Dokumen</th>
                                    <th style="width: 10%">Kode</th>
                                    <th class="text-center" style="width: 7%">Status</th>
                                    <th class="text-center" style="width: 7%">Link</th>
                                    <th class="text-center" style="width: 7%">File</th>
                                </thead>
                                <tbody id="dokumen_induk">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between"">
                        <button type="submit" class="btn btn-sm btn-dark"><i class="far fa-check-circle"></i> Submit
                            Check</button>

                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-cancel"></i> Cancel
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_dok_mutu">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dokumen Mutu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('save_dokumen_akreditasi') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="akreditasi_periode_id" value="{{ $AkreditasiPeriode->id }}"
                            readonly>
                        <input type="hidden" name="akreditasi_master_id" value="{{ $AkreditasiMaster->id }}" readonly>
                        <input type="hidden" name="unit_master_id" value="{{ $AkreditasiPeriode->unit_master_id }}"
                            readonly>
                        <input type="hidden" name="mutu_periode_id" value="{{ $AkreditasiPeriode->mutu_periode_id }}"
                            readonly>
                        <input type="hidden" name="dokumen_kategori" value="2" readonly>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable4" width="100%" cellspacing="0">
                                <thead>
                                    <th class="text-center" style="width: 7%"></th>
                                    <th style="width: 40%">Dokumen Mutu</th>
                                    <th>Uraian Dokumen</th>
                                    <th class="text-center" style="width: 10%">Link</th>
                                    <th class="text-center" style="width: 10%">File</th>
                                </thead>
                                <tbody id="dokumen_mutu">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between"">
                        <button type="submit" class="btn btn-sm btn-dark"><i class="far fa-check-circle"></i> Submit
                            Check</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-cancel"></i> Cancel
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_dok_monev">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dokumen Kinerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('save_dokumen_akreditasi') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="akreditasi_periode_id" value="{{ $AkreditasiPeriode->id }}"
                            readonly>
                        <input type="hidden" name="akreditasi_master_id" value="{{ $AkreditasiMaster->id }}" readonly>
                        <input type="hidden" name="unit_master_id" value="{{ $AkreditasiPeriode->unit_master_id }}"
                            readonly>
                        <input type="hidden" name="mutu_periode_id" value="{{ $AkreditasiPeriode->mutu_periode_id }}"
                            readonly>
                        <input type="hidden" name="dokumen_kategori" value="3" readonly>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable5" width="100%" cellspacing="0">
                                <thead>
                                    <th class="text-center" style="width:5%"></th>
                                    <th style="width: 30%">Standar SPMI</th>
                                    <th style="width: 30%">Dokumen Kinerja</th>
                                    <th>Uraian Dokumen</th>
                                    <th class="text-center" style="width:7%">Link</th>
                                    <th class="text-center" style="width:7%">File</th>
                                </thead>
                                <tbody id="dokumen_monev">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between"">
                        <button type="submit" class="btn btn-sm btn-dark"><i class="far fa-check-circle"></i> Submit
                            Check</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-cancel"></i> Cancel
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $('select').select2();

        $(document).ready(function() {
            $('#dataTable').DataTable({
                "responsive": true
            });
            // });
            // $(document).ready(function() {
            $('#dataTable1').DataTable();
            // });
            // $(document).ready(function() {
            $('#table_kinerja').DataTable({
                "responsive": true
            });
            // });
            // $(document).ready(function() {
            $('#dataTable3').DataTable({
                "responsive": true
            });
            // });
            // $(document).ready(function() {
            $('#dataTable4').DataTable({
                "responsive": true
            });
            // });
            // $(document).ready(function() {
            $('#dataTable5').DataTable({
                "responsive": true
            });
        });

        $(".btn_delete").click(function() {
            swal({
                    title: "Are you sure?",
                    text: "You Want to Delete this Data...?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.form.submit();
                        swal("Deleted Successfully", {
                            icon: "success",
                        });
                    }
                });

        });

        $(document).ready(function() {
            $('.toastsDefaultWarning').Toasts('create', {
                class: 'bg-maroon',
                title: 'VAILED PROCESS !!!',
                autohide: true,
                delay: 5000,
                body: 'Submit Gagal, Data yang dimasukkan tidak valid'
            })
        });

        $(document).ready(function() {
            $("#btn_induk").click(function(e) {
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var mutu_dokumen_id = $('#mutu_dokumen_id').find(":selected").val();
                var akreditasi_periode_id = $('#akreditasi_periode_id').val();
                var unit_master_id = $('#unit_master_id').val();
                var kategori = $('#kategori').val();

                $.ajax({
                    url: "{{ route('cari_dokumen_akreditasi') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        mutu_dokumen_id: mutu_dokumen_id,
                        akreditasi_periode_id: akreditasi_periode_id,
                        unit_master_id: unit_master_id,
                        kategori: kategori
                    },
                    success: function(items) {
                        // console.log(items);
                        $("#add_dok_induk").modal("show");
                        var res = '';
                        var storageUrl = "{{ request()->getHttpHost() }}/storage";
                        $.each(items, function(key, value) {
                            var pathFile = "http://" + storageUrl + "/" + value
                                .file_dokumen;
                            if (value.status == 1) {
                                var status =
                                    '<span class="badge bg-danger">True</span>';
                            } else {
                                var status = '<span class="badge bg-dark">False</span>';
                            }
                            if (value.link_dokumen) {
                                var link =
                                    '<a target="_blank" class="btn-sm btn-outline-primary" href="' +
                                    value.link_dokumen +
                                    '"><i class="far fa-folder-open"></i></a>';
                            } else {
                                var link = '<span class="badge bg-danger">empty</span>';
                            }
                            if (value.file_dokumen) {
                                var file =
                                    '<a target="_blank" class="btn-sm btn-outline-primary" href="' +
                                    pathFile +
                                    '"><i class="far fa-folder-open"></i></a>';
                            } else {
                                var file = '<span class="badge bg-danger">empty</span>';
                            }
                            res +=
                                '<tr>' +
                                '<td class="text-center" style="width: 5%"><input type="checkbox" name="dokumen_id[]" value ="' +
                                value.id + '"></td >' +
                                '<td style="width: 35%">' + value.mutu_dokumen
                                .nm_dokumen_mutu + '</td>' +
                                '<td>' + value.nm_dokumen_induk + '</td>' +
                                '<td style="width: 10%">' + value.no_dokumen_induk +
                                '</td>' +
                                '<td class="text-center" style="width: 7%">' + status +
                                '</td>' +
                                '<td class="text-center" style="width: 7%">' + link +
                                '</td>' +
                                '<td class="text-center" style="width: 7%">' + file +
                                '</td>' +
                                '</tr>';

                        });

                        $('#add_dok_induk tbody').html(res);
                    }
                });
            });
            // });

            // $(document).ready(function() {
            $("#btn_mutu").click(function(e) {
                e.preventDefault();

                var _token = $("input[name='_token']").val();

                var mutu_dokumen_id = $('#mutu_dokumen_id_mt').find(":selected").val();
                var akreditasi_periode_id = $('#akreditasi_periode_id').val();
                var unit_master_id = $('#unit_master_id').val();
                var mutu_periode_id = $('#mutu_periode_id').val();
                var kategori = $('#kategori_mt').val();

                $.ajax({
                    url: "{{ route('cari_dokumen_akreditasi') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        mutu_dokumen_id: mutu_dokumen_id,
                        akreditasi_periode_id: akreditasi_periode_id,
                        unit_master_id: unit_master_id,
                        mutu_periode_id: mutu_periode_id,
                        kategori: kategori
                    },
                    success: function(data) {
                        // console.log(data);
                        $("#add_dok_mutu").modal("show");
                        var storageUrl = "{{ request()->getHttpHost() }}/storage";
                        var res = '';
                        $.each(data, function(key, value) {
                            var pathFile = "http://" + storageUrl + "/" + value
                                .file_dokumen;
                            if (value.link_dokumen) {
                                var link =
                                    '<a target="_blank" class="btn-sm btn-outline-primary" href="' +
                                    value.link_dokumen +
                                    '"><i class="far fa-folder-open"></i></a>';
                            } else {
                                var link = '<span class="badge bg-danger">empty</span>';
                            }
                            if (value.file_dokumen) {
                                var file =
                                    '<a target="_blank" class="btn-sm btn-outline-primary" href="' +
                                    pathFile +
                                    '"><i class="far fa-folder-open"></i></a>';
                            } else {
                                var file = '<span class="badge bg-danger">empty</span>';
                            }
                            res +=
                                '<tr>' +
                                '<td class="text-center" style="width: 7%"><input type="checkbox" name="dokumen_id[]" value ="' +
                                value.id + '"></td >' +
                                '<td style="width: 40%">' + value.mutu_dokumen
                                .nm_dokumen_mutu + '</td>' +
                                '<td>' + value.nm_detail_dokumen_mutu + '</td>' +
                                '<td class="text-center" style="width: 10%">' + link +
                                '</td>' +
                                '<td class="text-center" style="width: 10%">' + file +
                                '</td>' +
                                '</tr>';

                        });

                        $('#add_dok_mutu tbody').html(res);
                    }
                });
            });

            $("#btn_monev").click(function(e) {
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var mutu_dokumen_id = $('#mutu_dokumen_id_mv').find(":selected").val();
                var akreditasi_periode_id = $('#akreditasi_periode_id').val();
                var unit_master_id = $('#unit_master_id').val();
                var mutu_periode_id = $('#mutu_periode_id').val();
                var kinerja = $('#jenis_kinerja').val();
                var kategori = $('#kategori_mv').val();

                $.ajax({
                    url: "{{ route('cari_dokumen_akreditasi') }}",
                    type: 'POST',
                    data: {
                        _token: _token,
                        mutu_dokumen_id: mutu_dokumen_id,
                        akreditasi_periode_id: akreditasi_periode_id,
                        unit_master_id: unit_master_id,
                        mutu_periode_id: mutu_periode_id,
                        kinerja: kinerja,
                        kategori: kategori
                    },
                    success: function(monev) {
                        // console.log(monev);
                        $("#add_dok_monev").modal("show");
                        var storageUrl = "{{ request()->getHttpHost() }}/storage";
                        var res = '';
                        $.each(monev, function(key, value) {
                            var pathFile = "http://" + storageUrl + "/" + value
                                .file_dokumen;
                            if (value.link_dokumen) {
                                var link =
                                    '<a target="_blank" class="btn-sm btn-outline-primary" href="' +
                                    value.link_dokumen +
                                    '"><i class="far fa-folder-open"></i></a>';
                            } else {
                                var link = '<span class="badge bg-danger">empty</span>';
                            }
                            if (value.file_dokumen) {
                                var file =
                                    '<a target="_blank" class="btn-sm btn-outline-primary" href="' +
                                    pathFile +
                                    '"><i class="far fa-folder-open"></i></a>';
                            } else {
                                var file = '<span class="badge bg-danger">empty</span>';
                            }
                            res +=
                                '<tr>' +
                                '<td class="text-center" style="width:5%"><input type="checkbox" name="dokumen_id[]" value ="' +
                                value.id + '"></td >' +
                                '<td style="width: 30%">' + value.spmi_standar_master
                                .nm_standar_spmi +
                                '</td>' +
                                '<td style="width: 30%">' + value.mutu_dokumen
                                .nm_dokumen_mutu + '</td>' +
                                '<td>' + value.nm_dokumen_monev + '</td>' +
                                '<td class="text-center" style="width:7%">' + link +
                                '</td>' +
                                '<td class="text-center" style="width:7%">' + file +
                                '</td>' +
                                '</tr>';

                        });

                        $('#add_dok_monev tbody').html(res);
                    }
                });
            });
        });
    </script>
@endsection
