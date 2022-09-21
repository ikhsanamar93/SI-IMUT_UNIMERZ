@extends('layouts.main')
@section('title', 'SI-IMUT | Kategori Mutu')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultMaroon"></div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Input Kategori SPMI</h3>
            </div>
            <form action="{{ route('kategori_mutu.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Sistem Mutu <span>*</span></label>
                        <select name="mutu_sistem_id"
                            class="form-control form-control-sm select2 @error('mutu_sistem_id') is-invalid @enderror"
                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                            <option></option>
                            @foreach ($MutuSistems as $MutuSistem)
                                @if (old('mutu_sistem_id') == $MutuSistem->id)
                                    <option value="{{ $MutuSistem->id }}" selected>{{ $MutuSistem->nm_sistem_mutu }}
                                    </option>
                                @else
                                    <option value="{{ $MutuSistem->id }}">{{ $MutuSistem->nm_sistem_mutu }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('mutu_sistem_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori SPMI <span>*</span></label>
                        <input type="text"
                            class="form-control form-control-sm @error('nm_kategori_mutu') is-invalid @enderror"
                            name="nm_kategori_mutu" placeholder="Input SPMI" value="{{ old('nm_kategori_mutu') }}"
                            required>
                        @error('nm_kategori_mutu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kode Kategori SPMI</label>
                        <input type="text"
                            class="form-control form-control-sm @error('no_kategori_mutu') is-invalid @enderror"
                            name="no_kategori_mutu" placeholder="Nomor SPMI" value="{{ old('no_kategori_mutu') }}"
                            maxlength="30">
                        @error('no_kategori_mutu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label>Deskripsi Kategori SPMI</label>
                        <textarea class="form-control form-control-sm @error('ket') is-invalid @enderror" rows="4" name="ket"
                            placeholder="Deskripsi SPMI ...">{{ old('ket') }}</textarea>
                        @error('ket')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-dark">
                        <i class="far fa-circle-check"></i></i> Submit
                    </button>
                    <button type="reset" class="btn btn-sm btn-danger float-right">
                        <i class="fa fa-cancel"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Kategori SPMI</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dttable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Sistem SPMI</th>
                                <th>Nama Dokumen SPMI</th>
                                <th>Kode SPMI</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MutuKategoris as $MutuKategori)
                                <tr id="hide{{ $MutuKategori->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $MutuKategori->mutu_sistem->nm_sistem_mutu }}</td>
                                    <td>{{ $MutuKategori->nm_kategori_mutu }}</td>
                                    <td>{{ $MutuKategori->no_kategori_mutu }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('kategori_mutu.edit', $MutuKategori->id) }}"
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

            <div class="modal fade" id="update">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kategori SPMI</h5>
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
                                    <label>Sistem Mutu <span>*</span></label>
                                    <select name="mutu_sistem_id_m" id="mutu_sistem_id_m"
                                        class="form-control form-control-sm select2 @error('mutu_sistem_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @foreach ($MutuSistems as $MutuSistem)
                                            <option value="{{ $MutuSistem->id }}">{{ $MutuSistem->nm_sistem_mutu }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mutu_sistem_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Kategori SPMI <span>*</span></label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('nm_kategori_mutu_m') is-invalid @enderror"
                                        name="nm_kategori_mutu_m" placeholder="Input SPMI"
                                        value="{{ old('nm_kategori_mutu_m') }}" required>
                                    @error('nm_kategori_mutu_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Kategori SPMI</label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('no_kategori_mutu_m') is-invalid @enderror"
                                        name="no_kategori_mutu_m" placeholder="Nomor SPMI"
                                        value="{{ old('no_kategori_mutu_m') }}" maxlength="20">
                                    @error('no_kategori_mutu_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Deskripsi Kategori SPMI</label>
                                    <textarea class="form-control form-control-sm @error('ket_m') is-invalid @enderror" rows="4" name="ket_m"
                                        placeholder="Deskripsi SPMI ...">{{ old('ket_m') }}</textarea>
                                    @error('ket_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-circle-check"></i> Update
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script>
        $(document).ready(function() {
            $('#dttable').DataTable();
        });

        $('select').select2();

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
                let update = "{{ url('kategori_mutu') }}" + '/' + data.id;
                //console.log(update);
                $('.modal select[name=mutu_sistem_id_m]').val(data.mutu_sistem_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('.modal input[name=nm_kategori_mutu_m]').val(data.nm_kategori_mutu);
                $('.modal input[name=no_kategori_mutu_m]').val(data.no_kategori_mutu);
                $('.modal textarea[name=ket_m]').val(data.ket);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
