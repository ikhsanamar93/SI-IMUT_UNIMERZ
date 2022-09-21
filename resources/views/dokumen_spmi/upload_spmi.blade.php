@extends('layouts.main')
@section('title', 'SI-IMUT | Upload SPMI')
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
                <h3 class="card-title">Upload Dokumen SPMI</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('spmi.show', Crypt::encrypt($SpmiMasterDokumens->unit_master_id)) }}"
                            class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>
            <form method="POST" action="{{ route('spmi_dokumen.store') }}" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Kategori Dokumen *</label>
                        <select name="mutu_kategori_id"
                            class="form-control form-control-sm select2 @error('mutu_kategori_id') is-invalid @enderror"
                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                            <option></option>
                            @foreach ($MutuKategoris as $MutuKategori)
                                @if (old('mutu_kategori_id') == $MutuKategori->id)
                                    <option value="{{ $MutuKategori->id }}" selected>
                                        {{ $MutuKategori->nm_kategori_mutu }}
                                    </option>
                                @else
                                    <option value="{{ $MutuKategori->id }}">{{ $MutuKategori->nm_kategori_mutu }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('mutu_kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Uraian Dokumen *</label>
                        <input type="text" name="nm_detail_spmi"
                            class="form-control form-control-sm @error('nm_detail_spmi') is-invalid @enderror"
                            value="{{ old('nm_detail_spmi') }}" placeholder="Nama Dokumen SPMI" required>
                        @error('nm_detail_spmi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kode Dokumen *</label>
                        <input type="text" name="no_detail_spmi"
                            class="form-control form-control-sm @error('no_detail_spmi') is-invalid @enderror"
                            value="{{ old('no_detail_spmi') }}" placeholder="No Dokumen SPMI" maxlength="30" required>
                        @error('no_detail_spmi')
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
                            <input name="link_spmi" type="url"
                                class="form-control form-control-sm @error('link_spmi') is-invalid @enderror"
                                value="{{ old('link_spmi') }}" placeholder="Link Dokumen">
                            @error('link_spmi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label>File Dokumen</label>
                        <span class="text-xs"><i> (.PDF Format max. 5 MB)</i></span>
                        <div class="input-group-sm">
                            <div class="custom-file input-sm">
                                <input name="file_spmi" type="file" accept="application/pdf"
                                    class="form-control-sm @error('file_spmi') is-invalid @enderror" id="exampleInputFile">
                                <label class="custom-file-label form-control-sm" for="exampleInputFile">Choose file</label>
                                @error('file_spmi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{ Crypt::encrypt($SpmiMasterDokumens->id) }}"
                        name="spmi_master_dokumen_id" class="form-control form-control-sm" readonly required>
                    <input type="hidden" value="{{ $SpmiMasterDokumens->unit_master_id }}" name="unit_master_id"
                        class="form-control form-control-sm" readonly required>
                </div>
                <div class="card-footer">
                    @can('admin')
                        <button type="submit" class="btn btn-sm btn-dark">
                            <i class="far fa-check-circle"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-sm btn-danger float-right">
                            <i class="fa fa-cancel"></i> Cancel
                        </button>
                    @endcan
                </div>
            </form>
        </div>

        <div class="modal fade" id="update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Dokumen Induk</h5>
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
                                <label>Kategori Dokumen *</label>
                                <select name="mutu_kategori_id_m"
                                    class="form-control form-control-sm select2 @error('mutu_kategori_id_m') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    @foreach ($MutuKategoris as $MutuKategori)
                                        <option value="{{ $MutuKategori->id }}">{{ $MutuKategori->nm_kategori_mutu }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mutu_kategori_id_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Uraian Dokumen *</label>
                                <input type="text" name="nm_detail_spmi_m"
                                    class="form-control form-control-sm @error('nm_detail_spmi_m') is-invalid @enderror"
                                    placeholder="Nama Dokumen SPMI" required>
                                @error('nm_detail_spmi_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kode Dokumen *</label>
                                <input type="text" name="no_detail_spmi_m"
                                    class="form-control form-control-sm @error('no_detail_spmi_m') is-invalid @enderror"
                                    placeholder="No Dokumen SPMI" maxlength="20" required>
                                @error('no_detail_spmi_m')
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
                                    <input name="link_spmi_m" type="url"
                                        class="form-control form-control-sm @error('link_spmi_m') is-invalid @enderror"
                                        placeholder="Link Dokumen">
                                    @error('link_spmi_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label>File Dokumen</label>
                                <span class="text-xs"><i> (.PDF Format max. 5 MB)</i></span>
                                <div class="input-group-sm">
                                    <div class="custom-file input-sm">
                                        <input name="file_spmi_m" type="file" accept="application/pdf"
                                            class="form-control-sm @error('file_spmi_m') is-invalid @enderror"
                                            id="exampleInputFile1">
                                        <label class="custom-file-label form-control-sm" for="exampleInputFile1">Choose
                                            file</label>
                                        @error('file_spmi_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="old_file" class="form-control form-control-sm" readonly>
                            <input type="hidden" value="{{ $SpmiMasterDokumens->id }}"
                                name="spmi_master_dokumen_id_m" class="form-control form-control-sm" readonly required>
                            <input type="hidden" value="{{ $SpmiMasterDokumens->unit_master_id }}"
                                name="unit_master_id_m" class="form-control form-control-sm" readonly required>
                        </div>
                        <div class="modal-footer justify-content-between">
                            @can('admin')
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-check-circle"></i> Update
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="fa fa-cancel"></i> Cancel
                                </button>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Dokumen SPMI</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Kategori Dokumen</th>
                                <th>Uraian Dokumen</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">File</th>
                                @can('admin')
                                    <th></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SpmiDetailDokumens as $SpmiDetailDokumen)
                                <tr id="hide{{ $SpmiDetailDokumen->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $SpmiDetailDokumen->mutu_kategori->nm_kategori_mutu }}</td>
                                    <td>{{ $SpmiDetailDokumen->nm_detail_spmi }}</td>
                                    <td class="text-center">
                                        @if ($SpmiDetailDokumen->link_spmi)
                                            <a target="_blank" class="btn-sm btn-outline-primary"
                                                href="{{ $SpmiDetailDokumen->link_spmi }}">
                                                <i class="far fa-folder-open"></i>
                                            </a>
                                        @else
                                            <span class="badge bg-danger">empty</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($SpmiDetailDokumen->file_spmi)
                                            <a target="_blank" class="btn-sm btn-outline-primary"
                                                href="{{ asset('storage/' . $SpmiDetailDokumen->file_spmi) }}">
                                                <i class="far fa-folder-open"></i>
                                            </a>
                                        @else
                                            <span class="badge bg-danger">empty</span>
                                        @endif
                                    </td>
                                    @can('admin')
                                        <td>
                                            <div class="text-center">
                                                <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                    onclick="edit(this)"
                                                    data-route="{{ route('spmi_dokumen.edit', $SpmiDetailDokumen->id) }}"
                                                    data-toggle="modal" data-target="#update">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                </a>
                                                <form action="{{ route('spmi_dokumen.destroy', $SpmiDetailDokumen->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('Delete')
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger border-0 btn_delete"><i
                                                            class="far fa-trash-can"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    @endcan
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
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('spmi_dokumen') }}" + '/' + data.id;
                //console.log(update);
                $('.modal select[name=mutu_kategori_id_m]').val(data.mutu_kategori_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('.modal input[name=nm_detail_spmi_m]').val(data.nm_detail_spmi);
                $('.modal input[name=no_detail_spmi_m]').val(data.no_detail_spmi);
                $('.modal input[name=link_spmi_m]').val(data.link_spmi);
                $('.modal input[name=old_file]').val(data.file_spmi);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
