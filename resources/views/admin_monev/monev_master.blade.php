@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Master Monev Mutu')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Input Master Monev</h3>
            </div>
            <form action="{{ route('monev_master.store') }}" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Jenis Monev <span>*</span></label>
                        <select name="monev_kategori_id"
                            class="form-control form-control-sm select2 @error('monev_kategori_id') is-invalid @enderror"
                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                            <option></option>
                            @foreach ($MonevKategoris as $MonevKategori)
                                @if (old('monev_kategori_id') == $MonevKategori->id)
                                    <option value="{{ $MonevKategori->id }}" selected>
                                        {{ $MonevKategori->nm_jenis_monev }}</option>
                                @else
                                    <option value="{{ $MonevKategori->id }}">{{ $MonevKategori->nm_jenis_monev }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('monev_kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Monev <span>*</span></label>
                        <input type="text" name="nm_monev"
                            class="form-control form-control-sm @error('nm_monev') is-invalid @enderror"
                            value="{{ old('nm_monev') }}" placeholder="Nama Monev" required>
                        @error('nm_monev')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kode Monev </label>
                        <input type="text" name="no_monev"
                            class="form-control form-control-sm @error('no_monev') is-invalid @enderror"
                            value="{{ old('no_monev') }}" placeholder="Kode Monev" maxlength="30">
                        @error('no_monev')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label>Deskripsi Monev </label>
                        <textarea class="form-control form-control-sm @error('ket') is-invalid @enderror" rows="4" name="ket"
                            placeholder="Deskripsi Dokumen Monev ...">{{ old('ket') }}</textarea>
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
                            <h5 class="modal-title">Edit Master Monev</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" autocomplete="off">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Jenis Monev <span>*</span></label>
                                    <select name="monev_kategori_id_m"
                                        class="form-control form-control-sm select2 @error('monev_kategori_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($MonevKategoris as $MonevKategori)
                                            @if (old('monev_kategori_id_m') == $MonevKategori->id)
                                                <option value="{{ $MonevKategori->id }}" selected>
                                                    {{ $MonevKategori->nm_jenis_monev }}</option>
                                            @else
                                                <option value="{{ $MonevKategori->id }}">
                                                    {{ $MonevKategori->nm_jenis_monev }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('monev_kategori_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Monev <span>*</span></label>
                                    <input type="text" name="nm_monev_m"
                                        class="form-control form-control-sm @error('nm_monev_m') is-invalid @enderror"
                                        value="{{ old('nm_monev_m') }}" placeholder="Nama Monev" required>
                                    @error('nm_monev_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Monev </label>
                                    <input type="text" name="no_monev_m"
                                        class="form-control form-control-sm @error('no_monev_m') is-invalid @enderror"
                                        value="{{ old('no_monev_m') }}" placeholder="Kode Monev" maxlength="30">
                                    @error('no_monev_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Deskripsi Monev </label>
                                    <textarea class="form-control form-control-sm @error('ket_m') is-invalid @enderror" rows="4" name="ket_m"
                                        placeholder="Deskripsi Dokumen Monev ...">{{ old('ket_m') }}</textarea>
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
                <h3 class="card-title">Data Master Monev</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Jenis Monev</th>
                                <th>Dokumen Monev</th>
                                {{-- <th>Kode Monev</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MonevMasters as $MonevMaster)
                                <tr id="hide{{ $MonevMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $MonevMaster->monev_kategori->nm_jenis_monev }}</td>
                                    <td>{{ $MonevMaster->nm_monev }}</td>
                                    {{-- <td>{{$MonevMaster->no_monev}}</td> --}}
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('monev_master.edit', $MonevMaster->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
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
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('monev_master') }}" + '/' + data.id;
                //console.log(update);
                $('.modal select[name=monev_kategori_id_m]').val(data.monev_kategori_id).attr("selected",
                    "selected").select2().trigger('change');
                $('.modal input[name=nm_monev_m]').val(data.nm_monev);
                $('.modal input[name=no_monev_m]').val(data.no_monev);
                $('.modal textarea[name=ket_m]').val(data.ket);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
