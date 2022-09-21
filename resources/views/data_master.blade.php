@extends('layouts.main')
@section('title', 'SI-IMUT | Data Master')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultMaroon"></div>
        @endif
    </div>

    <div class="col-md-7">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Provinsi</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('simpan_provinsi') }}" autocomplete="off">
                    @csrf
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">Nama Provinsi *</label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control form-control-sm @error('nm_provinsi') is-invalid @enderror"
                                name="nm_provinsi" value="{{ old('nm_provinsi') }}" placeholder="Nama Provinsi" required>
                            @error('nm_provinsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">Kode Provinsi *</label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control form-control-sm @error('no_provinsi') is-invalid @enderror"
                                name="no_provinsi" value="{{ old('no_provinsi') }}" maxlength="12"
                                placeholder="Kode Provinsi" required>
                            @error('no_provinsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-sm btn-dark">
                                <i class="far fa-check-circle"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Provinsi</th>
                                <th>Kode Provinsi</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ProvinsiMasters as $ProvinsiMaster)
                                <tr id="hide{{ $ProvinsiMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $ProvinsiMaster->nm_provinsi }}</td>
                                    <td>{{ $ProvinsiMaster->no_provinsi }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('show_kabupaten', Crypt::encrypt($ProvinsiMaster->no_provinsi)) }}"
                                            class="btn-sm btn-outline-primary" data-toggle="tooltip" title="View/Post"><i
                                                class="fa fa-table-columns"></i></a>
                                        <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                            onclick="edit_provinsi(this)"
                                            data-route="{{ route('edit_provinsi', $ProvinsiMaster->id) }}"
                                            data-toggle="modal" data-target="#update_provinsi">
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
        <div class="modal fade" id="update_provinsi">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Provinsi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Nama Provinsi *</label>
                                <input type="text"
                                    class="form-control form-control-sm @error('nm_provinsi_m') is-invalid @enderror"
                                    name="nm_provinsi_m" value="{{ old('nm_provinsi_m') }}" placeholder="Nama Provinsi"
                                    required>
                                @error('nm_provinsi_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Kode Provinsi *</label>
                                <input type="text"
                                    class="form-control form-control-sm @error('no_provinsi_m') is-invalid @enderror"
                                    name="no_provinsi_m" value="{{ old('no_provinsi_m') }}" maxlength="12"
                                    placeholder="Kode Provinsi" required>
                                @error('no_provinsi_m')
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
                            <button type="button" class="btn btn-sm  btn-danger" data-dismiss="modal">
                                <i class="fa fa-cancel"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Tahun</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('simpan_tahun') }}" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control form-control-sm @error('tahun') is-invalid @enderror" name="tahun"
                                value="{{ old('tahun') }}" placeholder="Tahun" required>
                            @error('tahun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-sm btn-dark">
                                <i class="far fa-check-circle"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <div class="card-body table-bordered table-responsive p-0" style="height: 400px;">
                        <table class="table table-head-fixed">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($TahunMasters as $TahunMaster)
                                    <tr id="hide{{ $TahunMaster->id }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $TahunMaster->tahun }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit_tahun(this)"
                                                data-route="{{ route('edit_tahun', $TahunMaster->id) }}"
                                                data-toggle="modal" data-target="#update_tahun">
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

        <div class="modal fade" id="update_tahun">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Tahun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tahun <span>*</span></label>
                                <input type="text"
                                    class="form-control form-control-sm @error('tahun_m') is-invalid @enderror"
                                    name="tahun_m" value="{{ old('tahun_m') }}" placeholder="Tahun" required>
                                @error('tahun_m')
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
                            <button type="button" class="btn btn-sm  btn-danger" data-dismiss="modal">
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script>
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

        function edit_tahun(el) {
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('update_tahun') }}" + '/' + data.id;
                console.log(update);
                $('.modal input[name=tahun_m]').val(data.tahun);
                $('.modal form').attr('action', update);
            });
        }

        function edit_provinsi(el) {
            let url = $(el).data('route');
            $.get(url, function(data) {
                console.log(data);
                let update = "{{ url('update_provinsi') }}" + '/' + data.id;
                console.log(update);
                $('.modal input[name=nm_provinsi_m]').val(data.nm_provinsi);
                $('.modal input[name=no_provinsi_m]').val(data.no_provinsi);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
