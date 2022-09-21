@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Dokumen Induk')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Dokumen Induk</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        @can('admin')
                            <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                                <i class="fa fa-plus"></i> Add Dokumen
                            </a>
                        @endcan
                        <a href="{{ route('induk_master_dokumen.index') }}" class="btn-sm btn-outline-danger"><i
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
                                <th>Dokumen Induk</th>
                                <th>Uraian Dokumen</th>
                                <th>Kode</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">File</th>
                                @can('admin')
                                    <th class="text-center"></th>
                                @endcan
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
                                            <span class="badge bg-danger">True</span>
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
                                    @can('admin')
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success" onclick="edit(this)"
                                                data-route="{{ route('induk_master_dokumen.edit', $IndukMasterDokumen->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            <form
                                                action="{{ route('induk_master_dokumen.destroy', $IndukMasterDokumen->id) }}"
                                                method="POST" class="d-inline">
                                                @method('Delete')
                                                @csrf
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger border-0 btn_delete"><i
                                                        class="far fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    @endcan
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
                            <h5 class="modal-title">Add Dokumen Induk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('induk_master_dokumen.store') }}" method="post"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Dokumen Induk <span>*</span></label>
                                    <div class="col-sm-9">
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
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unit Kerja <span>*</span></label>
                                    <div class="col-sm-9">
                                        <select name="unit_master_id"
                                            class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            @foreach ($UnitMasters as $UnitMaster)
                                                <option value="{{ $UnitMaster->id }}" selected>
                                                    {{ $UnitMaster->nm_unit }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('unit_master_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Uraian Dokumen <span>*</span></label>
                                    <div class="col-sm-9">
                                        <input name="nm_dokumen_induk" type="text"
                                            class="form-control form-control-sm @error('nm_dokumen_induk') is-invalid @enderror"
                                            value="{{ old('nm_dokumen_induk') }}" placeholder="Nama Dokumen" required>
                                        @error('nm_dokumen_induk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kode Dokumen</label>
                                    <div class="col-sm-9">
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
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Link Dokumen</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            </div>
                                            <input name="link_dokumen" type="url"
                                                class="form-control form-control-sm @error('link_dokumen') is-invalid @enderror"
                                                value="{{ old('link_dokumen') }}" placeholder="Link Dokumen">
                                            @error('link_dokumen')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">File Dokumen </label>
                                    <div class="col-sm-9">
                                        <div class="input-group-sm">
                                            <div class="custom-file input-sm">
                                                <input type="file" name="file_dokumen" accept="application/pdf"
                                                    class="form-control form-control-sm @error('file_dokumen') is-invalid @enderror"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label form-control-sm"
                                                    for="exampleInputFile">Choose file</label>
                                                @error('file_dokumen')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <span class="text-xs"><i> (.PDF Format max. 5 MB)</i></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Status Dokumen</label>
                                    <div class="col-sm-9">
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

            <div class="modal fade" id="update">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Dokumen Induk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Dokumen Induk <span>*</span></label>
                                    <div class="col-sm-9">
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
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unit Kerja <span>*</span></label>
                                    <div class="col-sm-9">
                                        <select name="unit_master_id_m"
                                            class="form-control form-control-sm select2 @error('unit_master_id_m') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            @foreach ($UnitMasters as $UnitMaster)
                                                <option value="{{ $UnitMaster->id }}" selected>
                                                    {{ $UnitMaster->nm_unit }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('unit_master_id_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Uraian Dokumen <span>*</span></label>
                                    <div class="col-sm-9">
                                        <input name="nm_dokumen_induk_m" type="text"
                                            class="form-control form-control-sm @error('nm_dokumen_induk_m') is-invalid @enderror"
                                            value="{{ old('nm_dokumen_induk_m') }}" placeholder="Nama Dokumen"
                                            required>
                                        @error('nm_dokumen_induk_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kode Dokumen</label>
                                    <div class="col-sm-9">
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
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Link Dokumen</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            </div>
                                            <input name="link_dokumen_m" type="url"
                                                class="form-control form-control-sm @error('link_dokumen_m') is-invalid @enderror"
                                                value="{{ old('link_dokumen_m') }}" placeholder="Link Dokumen">
                                            @error('link_dokumen_m')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">File Dokumen </label>
                                    <div class="col-sm-9">
                                        <div class="input-group-sm">
                                            <div class="custom-file input-sm">
                                                <input type="file" name="file_dokumen_m" accept="application/pdf"
                                                    class="form-control form-control-sm @error('file_dokumen_m') is-invalid @enderror"
                                                    id="exampleInputFile1">
                                                <label class="custom-file-label form-control-sm"
                                                    for="exampleInputFile1">Choose
                                                    file</label>
                                                @error('file_dokumen_m')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <span class="text-xs"><i>
                                                    (.PDF Format max. 5 MB)</i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label">Status Dokumen</label>
                                    <div class="col-sm-9">
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
                                <input type="hidden" name="old_file" class="form-control form-control-sm" readonly>
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
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/js/file_input.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $('select').select2();

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(function() {
            bsCustomFileInput.init();
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

        function edit(el) {
            var x = document.getElementById("status_m");
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('induk_master_dokumen') }}" + '/' + data.id;
                //console.log(update);
                $('#update select[name=mutu_dokumen_id_m]').val(data.mutu_dokumen_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update input[name=nm_dokumen_induk_m]').val(data.nm_dokumen_induk);
                $('#update input[name=no_dokumen_induk_m]').val(data.no_dokumen_induk);
                $('#update input[name=link_dokumen_m]').val(data.link_dokumen);
                $('#update input[name=old_file]').val(data.file_dokumen);
                if (data.status == 1) {
                    x.checked = true;
                } else {
                    x.checked = false;
                }
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
