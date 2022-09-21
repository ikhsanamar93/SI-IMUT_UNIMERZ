@extends('layouts.main')
@section('title', 'SI-IMUT | Upload Dokumen')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Upload Dokumen Mutu</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('mutu_master_dokumen.show', Crypt::encrypt($MutuMasterDokumens->unit_master_id)) }}"
                            class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>
            <form method="POST" action="{{ route('mutu_detail_dokumen.store') }}" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Uraian Dokumen Kinerja</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-institution"></i></span>
                            </div>
                            <input type="text" value="{{ $MutuMasterDokumens->unit_master->nm_unit }}"
                                name="unit_kerja" class="form-control form-control-sm text-uppercase" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" value="{{ $MutuMasterDokumens->mutu_periode->siklus }}"
                                name="mutu_periode" class="form-control form-control-sm text-uppercase" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dokumen Kinerja <span>*</span></label>
                        <select name="mutu_dokumen_id"
                            class="form-control form-control-sm select2 @error('mutu_dokumen_id') is-invalid @enderror"
                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                            <option></option>
                            @foreach ($MutuDokumens as $MutuDokumen)
                                <option value="{{ $MutuDokumen->id }}">
                                    {{ $MutuDokumen->nm_dokumen_mutu }}
                                </option>
                            @endforeach
                        </select>
                        @error('mutu_dokumen_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Uraian Dokumen *</label>
                        <input type="text" name="nm_detail_dokumen_mutu"
                            class="form-control form-control-sm @error('nm_detail_dokumen_mutu') is-invalid @enderror"
                            value="{{ old('nm_detail_dokumen_mutu') }}" placeholder="Uraian Dokumen" required>
                        @error('nm_detail_dokumen_mutu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Link Dokumen</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                            </div>
                            <input type="url" name="link_dokumen"
                                class="form-control form-control-sm @error('link_dokumen') is-invalid @enderror"
                                value="{{ old('link_dokumen') }}" placeholder="Link Dokumen">
                            @error('link_dokumen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label>File Dokumen </label>
                        <span class="text-xs"><i> (.PDF Format max. 5 MB)</i></span>
                        <div class="input-group-sm">
                            <div class="custom-file input-sm">
                                <input type="file" name="file_dokumen" accept="application/pdf"
                                    class="form-control form-control-sm @error('file_dokumen') is-invalid @enderror"
                                    id="exampleInputFile">
                                <label class="custom-file-label form-control-sm" for="exampleInputFile">Choose file</label>
                                @error('file_dokumen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $MutuMasterDokumens->id }}" class="form-control form-control-sm"
                        name="mutu_master_dokumen_id" readonly required>
                    <input type="hidden" value="{{ $MutuMasterDokumens->unit_master_id }}" name="unit_master_id"
                        class="form-control form-control-sm" readonly required>
                    <input type="hidden" value="{{ $MutuMasterDokumens->mutu_periode_id }}" name="mutu_periode_id"
                        class="form-control form-control-sm" readonly required>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-dark">
                        <i class="far fa-check-circle"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-sm btn-danger float-right">
                        <i class="fa fa-cancel"></i> Cancel
                    </button>
                </div>
            </form>
        </div>

        <div class="modal fade" id="update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Dokumen Mutu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <div class="callout callout-danger">
                                <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                            </div>
                            <div class="form-group">
                                <label>Uraian Dokumen Kinerja</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-institution"></i></span>
                                    </div>
                                    <input type="text" value="{{ $MutuMasterDokumens->unit_master->nm_unit }}"
                                        name="unit_kerja" class="form-control form-control-sm text-uppercase" readonly
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <input type="text" value="{{ $MutuMasterDokumens->mutu_periode->siklus }}"
                                        name="mutu_periode" class="form-control form-control-sm text-uppercase" readonly
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dokumen Kinerja <span>*</span></label>
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
                                <label>Uraian Dokumen</label>
                                <input type="text" name="nm_detail_dokumen_mutu_m"
                                    class="form-control form-control-sm @error('nm_detail_dokumen_mutu_m') is-invalid @enderror"
                                    value="{{ old('nm_detail_dokumen_mutu_m') }}" placeholder="Uraian Dokumen"
                                    required>
                                @error('nm_detail_dokumen_mutu_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Link Dokumen</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input type="url" name="link_dokumen_m"
                                        class="form-control form-control-sm @error('link_dokumen_m') is-invalid @enderror"
                                        value="{{ old('link_dokumen_m') }}" placeholder="Link Dokumen">
                                    @error('link_dokumen_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label>File Dokumen </label>
                                <span class="text-xs"><i> (.PDF Format max. 5 MB)</i></span>
                                <div class="input-group-sm">
                                    <div class="custom-file input-sm">
                                        <input type="file" name="file_dokumen_m" accept="application/pdf"
                                            class="form-control form-control-sm @error('file_dokumen_m') is-invalid @enderror"
                                            id="exampleInputFile1">
                                        <label class="custom-file-label form-control-sm" for="exampleInputFile1">Choose
                                            file</label>
                                        @error('file_dokumen_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="old_file" class="form-control form-control-sm" readonly>
                            <input type="hidden" value="{{ $MutuMasterDokumens->id }}"
                                class="form-control form-control-sm" name="mutu_master_dokumen_id_m" readonly required>
                            <input type="hidden" value="{{ $MutuMasterDokumens->unit_master_id }}"
                                name="unit_master_id_m" class="form-control form-control-sm" readonly required>
                            <input type="hidden" value="{{ $MutuMasterDokumens->mutu_periode_id }}"
                                name="mutu_periode_id_m" class="form-control form-control-sm" readonly required>
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
    <div class="col-md-8">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Dokumen Mutu</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Dokumen Kinerja</th>
                                <th>Uraian Dokumen</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">File</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MutuDetailDokumens as $MutuDetailDokumen)
                                <tr id="hide{{ $MutuDetailDokumen->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $MutuDetailDokumen->mutu_dokumen->nm_dokumen_mutu }}</td>
                                    <td>{{ $MutuDetailDokumen->nm_detail_dokumen_mutu }}</td>
                                    <td class="text-center">
                                        @if ($MutuDetailDokumen->link_dokumen)
                                            <a target="_blank" class="btn-sm btn-outline-primary"
                                                href="{{ $MutuDetailDokumen->link_dokumen }}">
                                                <i class="far fa-folder-open"></i>
                                            </a>
                                        @else
                                            <span class="badge bg-danger">empty</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($MutuDetailDokumen->file_dokumen)
                                            <a target="_blank" class="btn-sm btn-outline-primary"
                                                href="{{ asset('storage/' . $MutuDetailDokumen->file_dokumen) }}">
                                                <i class="far fa-folder-open"></i>
                                            </a>
                                        @else
                                            <span class="badge bg-danger">empty</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('mutu_detail_dokumen.edit', $MutuDetailDokumen->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            <form
                                                action="{{ route('mutu_detail_dokumen.destroy', $MutuDetailDokumen->id) }}"
                                                method="POST" class="d-inline">
                                                @method('Delete')
                                                @csrf
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger border-0 btn_delete"><i
                                                        class="far fa-trash-can"></i></button>
                                            </form>
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
    <script src="{{ asset('plugins/js/file_input.js') }}"></script>
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
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
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('mutu_detail_dokumen') }}" + '/' + data.id;
                //console.log(update);
                $('#update select[name=mutu_dokumen_id_m]').val(data.mutu_dokumen_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('.modal input[name=nm_detail_dokumen_mutu_m]').val(data.nm_detail_dokumen_mutu);
                $('.modal input[name=link_dokumen_m]').val(data.link_dokumen);
                $('.modal input[name=old_file]').val(data.file_dokumen);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
