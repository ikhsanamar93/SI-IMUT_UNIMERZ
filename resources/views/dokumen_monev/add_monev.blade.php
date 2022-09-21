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
                <h3 class="card-title">{{ $kinerja_kategoris }}</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('show_monev', Crypt::encrypt($MonevMasterDokumens->id)) }}"
                            class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>
            <form action="{{ route('save_monev') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group mb-1">
                        <label>Uraian {{ $kinerja_kategoris }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-gears"></i></span>
                            </div>
                            <input type="text" value="{{ $SpmiStandarMasters->nm_standar_spmi }}"
                                name="nm_standar_spmi" class="form-control form-control-sm text-uppercase" required
                                readonly>
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-institution"></i></span>
                            </div>
                            <input type="text" value="{{ $MonevMasterDokumens->unit_master->nm_unit }}" name="nm_unit"
                                class="form-control form-control-sm text-uppercase" required readonly>
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text"
                                value="{{ $MonevMasterDokumens->mutu_periode->siklus }} / {{ $MonevMasterDokumens->semester }}"
                                name="siklus" class="form-control form-control-sm text-uppercase" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dokumen Kinerja *</label>
                        <select name="mutu_dokumen_id"
                            class="form-control form-control-sm select2 @error('mutu_dokumen_id') is-invalid @enderror"
                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                            <option></option>
                            @foreach ($MutuDokumens as $MutuDokumen)
                                @if (old('mutu_dokumen_id') == $MutuDokumen->id)
                                    <option value="{{ $MutuDokumen->id }}" selected>
                                        {{ $MutuDokumen->nm_dokumen_mutu }}
                                    </option>
                                @else
                                    <option value="{{ $MutuDokumen->id }}">{{ $MutuDokumen->nm_dokumen_mutu }}
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
                        <label>Uraian Dokumen *</label>
                        <input type="text" name="nm_dokumen_monev"
                            class="form-control form-control-sm @error('nm_dokumen_monev') is-invalid @enderror"
                            value="{{ old('nm_dokumen_monev') }}" placeholder="Uraian Dokumen" required>
                        @error('nm_dokumen_monev')
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
                    <input type="hidden" value="{{ $MonevMasterDokumens->id }}" name="monev_master_dokumen_id"
                        class="form-control form-control-sm" readonly required>
                    <input type="hidden" value="{{ $SpmiStandarMasters->id }}" name="spmi_standar_master_id"
                        class="form-control form-control-sm" readonly required>
                    <input type="hidden" value="{{ $kinerja_kategoris }}" class="form-control form-control-sm"
                        name="kinerja_kategori" readonly required>
                    <input type="hidden" value="{{ $MonevMasterDokumens->unit_master_id }}" name="unit_master_id"
                        class="form-control form-control-sm" readonly required>
                    <input type="hidden" value="{{ $MonevMasterDokumens->mutu_periode_id }}" name="mutu_periode_id"
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
                        <h5 class="modal-title">Edit Kinerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="callout callout-danger">
                                <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                            </div>
                            <div class="form-group mb-1">
                                <label>Uraian {{ $kinerja_kategoris }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-gears"></i></span>
                                    </div>
                                    <input type="text" value="{{ $SpmiStandarMasters->nm_standar_spmi }}"
                                        name="nm_standar_spmi" class="form-control form-control-sm text-uppercase"
                                        required readonly>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-institution"></i></span>
                                    </div>
                                    <input type="text" value="{{ $MonevMasterDokumens->unit_master->nm_unit }}"
                                        name="nm_unit" class="form-control form-control-sm text-uppercase" required
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <input type="text"
                                        value="{{ $MonevMasterDokumens->mutu_periode->siklus }} / {{ $MonevMasterDokumens->semester }}"
                                        name="siklus" class="form-control form-control-sm text-uppercase" required
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dokumen Kinerja *</label>
                                <select name="mutu_dokumen_id_m"
                                    class="form-control form-control-sm select2 @error('mutu_dokumen_id_m') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    @foreach ($MutuDokumens as $MutuDokumen)
                                        <option value="{{ $MutuDokumen->id }}">{{ $MutuDokumen->nm_dokumen_mutu }}
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
                                <label>Uraian Dokumen *</label>
                                <input type="text" name="nm_dokumen_monev_m"
                                    class="form-control form-control-sm @error('nm_dokumen_monev_m') is-invalid @enderror"
                                    value="{{ old('nm_dokumen_monev_m') }}" placeholder="Uraian Dokumen" required>
                                @error('nm_dokumen_monev_m')
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
                            <input type="hidden" value="{{ $MonevMasterDokumens->id }}"
                                name="monev_master_dokumen_id_m" class="form-control form-control-sm" readonly required>
                            <input type="hidden" value="{{ $SpmiStandarMasters->id }}"
                                name="spmi_standar_master_id_m" class="form-control form-control-sm" readonly required>
                            <input type="hidden" value="{{ $kinerja_kategoris }}"
                                class="form-control form-control-sm" name="kinerja_kategori_m" readonly required>
                            <input type="hidden" name="old_file" class="form-control form-control-sm" readonly>
                            <input type="hidden" value="{{ $MonevMasterDokumens->unit_master_id }}"
                                name="unit_master_id_m" class="form-control form-control-sm" readonly required>
                            <input type="hidden" value="{{ $MonevMasterDokumens->mutu_periode_id }}"
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
                <h3 class="card-title">Dokumen {{ $kinerja_kategoris }}</h3>
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
                            @foreach ($MonevDetailDokumens as $MonevDetailDokumen)
                                <tr id="hide{{ $MonevDetailDokumen->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $MonevDetailDokumen->mutu_dokumen->nm_dokumen_mutu }}</td>
                                    <td>{{ $MonevDetailDokumen->nm_dokumen_monev }}</td>
                                    <td class="text-center">
                                        @if ($MonevDetailDokumen->link_dokumen)
                                            <a target="_blank" class="btn-sm btn-outline-primary"
                                                href="{{ $MonevDetailDokumen->link_dokumen }}">
                                                <i class="far fa-folder-open"></i>
                                            </a>
                                        @else
                                            <span class="badge bg-danger">empty</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($MonevDetailDokumen->file_dokumen)
                                            <a target="_blank" class="btn-sm btn-outline-primary"
                                                href="{{ asset('storage/' . $MonevDetailDokumen->file_dokumen) }}">
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
                                                data-route="{{ route('edit_monev', $MonevDetailDokumen->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            <form action="{{ route('delete_monev', $MonevDetailDokumen->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" value="{{ $MonevMasterDokumens->id }}"
                                                    name="monev_master_dokumen_id" class="form-control form-control-sm"
                                                    readonly required>
                                                <input type="hidden" value="{{ $SpmiStandarMasters->id }}"
                                                    name="spmi_standar_master_id" class="form-control form-control-sm"
                                                    readonly required>
                                                <input type="hidden" value="{{ $kinerja_kategoris }}"
                                                    class="form-control form-control-sm" name="kinerja_kategori" readonly
                                                    required>
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
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/js/file_input.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(function() {
            bsCustomFileInput.init();
        });

        $('select').select2();

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
                let update = "{{ url('update_monev') }}" + '/' + data.id;
                //console.log(update);
                $('#update select[name=mutu_dokumen_id_m]').val(data.mutu_dokumen_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update input[name=nm_dokumen_monev_m]').val(data.nm_dokumen_monev);
                $('#update input[name=link_dokumen_m]').val(data.link_dokumen);
                $('#update input[name=old_file]').val(data.file_dokumen);
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
