@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Data Mahasiswa')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#add">
            <i class="fa fa-file-edit"></i> Add New</a>
        <a href="" class="btn btn-danger"><i class="fa fa-file-export"></i> Eksport Data</a>
        <a href="" class="btn btn-warning">
            <i class="fa fa-file-import"></i> Import Data</a>
        <p></p>
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Mahasiswa</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-download"></i> Template
                        </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nomor Induk</th>
                                <th>Nama Mahasiswa</th>
                                <th class="text-center">Gender</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MahasiswaMasters as $MahasiswaMaster)
                                <tr id="hide{{ $MahasiswaMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $MahasiswaMaster->nomor }}</td>
                                    <td>{{ $MahasiswaMaster->nama }}</td>
                                    <td>{{ $MahasiswaMaster->gender }}</td>
                                    <td>{{ $MahasiswaMaster->unit_master->nm_unit }}</td>
                                    <td class="text-center">{{ $MahasiswaMaster->angkatan_id }}</td>
                                    <td>
                                        <div class="text-center">
                                            @can('admin')
                                                <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                    onclick="edit(this)"
                                                    data-route="{{ route('induk_master_dokumen.edit', $MahasiswaMaster->id) }}"
                                                    data-toggle="modal" data-target="#update">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                </a>
                                            @endcan
                                            <a href="{{ route('induk_detail_dokumen.show', Crypt::encrypt($MahasiswaMaster->id)) }}"
                                                class="btn-sm btn-outline-danger" data-toggle="tooltip" title="View/Post"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="add">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Dokumen Induk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('induk_master_dokumen.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Dokumen Induk <span>*</span></label>
                                    <select name="mutu_dokumen_id"
                                        class="form-control form-control-sm select2 @error('mutu_dokumen_id') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($MutuDokumens as $MutuDokumen)
                                            @if (old('mutu_dokumen_id') == $MutuDokumen->id)
                                                <option value="{{ $MutuDokumen->id }}" selected>
                                                    {{ $MutuDokumen->nm_dokumen_mutu }}</option>
                                            @else
                                                <option value="{{ $MutuDokumen->id }}">
                                                    {{ $MutuDokumen->nm_dokumen_mutu }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('mutu_dokumen_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Unit Kerja <span>*</span></label>
                                    <select name="unit_master_id"
                                        class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @foreach ($UnitMasters as $UnitMaster)
                                            <option value="{{ $UnitMaster->id }}" selected>{{ $UnitMaster->nm_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_master_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Uraian Dokumen <span>*</span></label>
                                    <input name="nm_dokumen_induk" type="text"
                                        class="form-control form-control-sm @error('nm_dokumen_induk') is-invalid @enderror"
                                        value="{{ old('nm_dokumen_induk') }}" placeholder="Nama Dokumen" required>
                                    @error('nm_dokumen_induk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Dokumen</label>
                                    <input name="no_dokumen_induk" type="text"
                                        class="form-control form-control-sm @error('no_dokumen_induk') is-invalid @enderror"
                                        value="{{ old('no_dokumen_induk') }}" placeholder="Nomor Dokumen"
                                        maxlength="30">
                                    @error('no_dokumen_induk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Status Dokumen</label>
                                    <div class="form-check">
                                        <input name="status" value="1"
                                            class="form-check-input @error('status') is-invalid @enderror"
                                            type="checkbox">
                                        <label class="form-check-label">Aktif</label>
                                    </div>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-check-circle"></i> Submit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="fa fa-cancel"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- <div class="modal fade" id="update">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Dokumen Induk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" autocomplete="off">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Dokumen Induk <span>*</span></label>
                                    <select name="mutu_dokumen_id_m"
                                        class="form-control form-control-sm select2 @error('mutu_dokumen_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($MutuDokumens as $MutuDokumen)
                                            <option value="{{ $MutuDokumen->id }}">
                                                {{ $MutuDokumen->nm_dokumen_mutu }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mutu_dokumen_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Unit Kerja <span>*</span></label>
                                    <select name="unit_master_id_m"
                                        class="form-control form-control-sm select2 @error('unit_master_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @foreach ($UnitMasters as $UnitMaster)
                                            <option value="{{ $UnitMaster->id }}" selected>{{ $UnitMaster->nm_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_master_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Uraian Dokumen <span>*</span></label>
                                    <input name="nm_dokumen_induk_m" type="text"
                                        class="form-control form-control-sm @error('nm_dokumen_induk_m') is-invalid @enderror"
                                        value="{{ old('nm_dokumen_induk_m') }}" placeholder="Nama Dokumen" required>
                                    @error('nm_dokumen_induk_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Dokumen</label>
                                    <input name="no_dokumen_induk_m" type="text"
                                        class="form-control form-control-sm @error('no_dokumen_induk_m') is-invalid @enderror"
                                        value="{{ old('no_dokumen_induk_m') }}" placeholder="Nomor Dokumen"
                                        maxlength="30">
                                    @error('no_dokumen_induk_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Status Dokumen</label>
                                    <div class="form-check">
                                        <input name="status_m" id="status_m" value="1"
                                            class="form-check-input @error('status_m') is-invalid @enderror"
                                            type="checkbox">
                                        <label class="form-check-label">Aktif</label>
                                    </div>
                                    @error('status_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-check-circle"></i> Update
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="fa fa-cancel"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $('select').select2();

        $(document).ready(function() {
            $('#dataTable').DataTable();
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

        function edit(el) {
            var x = document.getElementById("status_spmi_m");
            let url = $(el).data('route');
            $.get(url, function(data) {
                console.log(data);
                let update = "{{ url('spmi') }}" + '/' + data.id;
                //console.log(update);
                $('#update select[name=mutu_sistem_id_m]').val(data.mutu_sistem_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=versi_master_id_m]').val(data.versi_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=unit_master_m]').val(data.unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update input[name=nm_spmi_m]').val(data.nm_spmi);
                $('#update input[name=no_spmi_m]').val(data.no_spmi);
                if (data.status_spmi == 1) {
                    x.checked = true;
                } else {
                    x.checked = false;
                }
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
