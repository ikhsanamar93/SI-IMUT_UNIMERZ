@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Dokumen Mutu')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultMaroon"></div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Input Dokumen Mutu</h3>
            </div>
            <form class="form-horizontal" action="{{ route('dokumen_mutu.store') }}" method="POST"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Dokumen Mutu <span>*</span></label>
                        <select name="jenis_dokumen_mutu"
                            class="form-control form-control-sm select2 @error('jenis_dokumen_mutu') is-invalid @enderror"
                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                            <option></option>
                            @if (old('jenis_dokumen_mutu') == 'Dokumen Induk')
                                <option value="Dokumen Induk" selected>Dokumen Induk</option>
                                <option value="Dokumen Kinerja">Dokumen Kinerja</option>
                            @elseif (old('jenis_dokumen_mutu') == 'Dokumen Kinerja')
                                <option value="Dokumen Induk">Dokumen Induk</option>
                                <option value="Dokumen Kinerja" selected>Dokumen Kinerja</option>
                            @else
                                <option value="Dokumen Induk">Dokumen Induk</option>
                                <option value="Dokumen Kinerja">Dokumen Kinerja</option>
                            @endif
                        </select>
                        @error('jenis_dokumen_mutu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Dokumen Mutu <span>*</span></label>
                        <input type="text" name="nm_dokumen_mutu"
                            class="form-control form-control-sm @error('nm_dokumen_mutu') is-invalid @enderror"
                            value="{{ old('nm_dokumen_mutu') }}" placeholder="Nama Dokumen" required>
                        @error('nm_dokumen_mutu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kode Dokumen Mutu </label>
                        <input type="text" name="no_dokumen_mutu"
                            class="form-control form-control-sm @error('no_dokumen_mutu') is-invalid @enderror"
                            value="{{ old('no_dokumen_mutu') }}" placeholder="Kode Dokumen" maxlength="30">
                        @error('no_dokumen_mutu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label>Deskripsi </label>
                        <textarea class="form-control form-control-sm @error('ket') is-invalid @enderror" rows="4" name="ket"
                            placeholder="Deskripsi Dokumen SPMI ...">{{ old('ket') }}</textarea>
                        @error('ket')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
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

            <div class="modal fade" id="update">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Dokumen Mutu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" autocomplete="off">
                            @method('PUT') @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Dokumen Mutu <span>*</span></label>
                                    <select name="jenis_dokumen_mutu_m"
                                        class="form-control form-control-sm select2 @error('jenis_dokumen_mutu_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        <option value="Dokumen Induk">Dokumen Induk</option>
                                        <option value="Dokumen Kinerja">Dokumen Kinerja</option>
                                    </select>
                                    @error('jenis_dokumen_mutu_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Dokumen Mutu <span>*</span></label>
                                    <input type="text" name="nm_dokumen_mutu_m"
                                        class="form-control form-control-sm @error('nm_dokumen_mutu_m') is-invalid @enderror"
                                        value="{{ old('nm_dokumen_mutu_m') }}" placeholder="Nama Dokumen" required>
                                    @error('nm_dokumen_mutu_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Dokumen Mutu </label>
                                    <input type="text" name="no_dokumen_mutu_m"
                                        class="form-control form-control-sm @error('no_dokumen_mutu_m') is-invalid @enderror"
                                        value="{{ old('no_dokumen_mutu_m') }}" placeholder="Kode Dokumen"
                                        maxlength="30">
                                    @error('no_dokumen_mutu_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Deskripsi </label>
                                    <textarea class="form-control form-control-sm @error('ket_m') is-invalid @enderror" rows="4" name="ket_m"
                                        placeholder="Deskripsi Dokumen SPMI ...">{{ old('ket_m') }}</textarea>
                                    @error('ket_m')
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
                                <th>Nama Dokumen</th>
                                <th>Kode Dokumen</th>
                                <th>Jenis Dokumen</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MutuDokumens as $MutuDokumen)
                                <tr id="hide{{ $MutuDokumen->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $MutuDokumen->nm_dokumen_mutu }}</td>
                                    <td>{{ $MutuDokumen->no_dokumen_mutu }}</td>
                                    <td>{{ $MutuDokumen->jenis_dokumen_mutu }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                            onclick="edit(this)"
                                            data-route="{{ route('dokumen_mutu.edit', $MutuDokumen->id) }}"
                                            data-toggle="modal" data-target="#update">
                                            <i class="fa fa-edit fa-fw"></i>
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
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $('select').select2();

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(document).ready(function() {
            $('.toastsDefaultMaroon').Toasts('create', {
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
                let update = "{{ url('dokumen_mutu') }}" + '/' + data.id;
                //console.log(update);
                $('.modal select[name=jenis_dokumen_mutu_m]').val(data.jenis_dokumen_mutu).attr("selected",
                    "selected").select2().trigger('change');
                $('.modal input[name=nm_dokumen_mutu_m]').val(data.nm_dokumen_mutu);
                $('.modal input[name=no_dokumen_mutu_m]').val(data.no_dokumen_mutu);
                $('.modal textarea[name=ket_m]').val(data.ket);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
