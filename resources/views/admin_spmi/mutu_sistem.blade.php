@extends('layouts.main')
@section('title', 'SI-IMUT | Sistem Mutu')
@section('css')
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
                <h3 class="card-title">Input SPMI</h3>
            </div>
            <form method="POST" action="{{ route('sistem_mutu.store') }}" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Nama SPMI <span>*</span></label>
                        <input type="text"
                            class="form-control form-control-sm @error('nm_sistem_mutu') is-invalid @enderror"
                            name="nm_sistem_mutu" value="{{ old('nm_sistem_mutu') }}" placeholder="Input SPMI" required>
                        @error('nm_sistem_mutu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kode SPMI</label>
                        <input type="text"
                            class="form-control form-control-sm @error('no_sistem_mutu') is-invalid @enderror"
                            name="no_sistem_mutu" value="{{ old('no_sistem_mutu') }}" maxlength="30"
                            placeholder="Nomor SPMI">
                        @error('no_sistem_mutu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi SPMI</label>
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
                        <h5 class="modal-title">Edit SPMI</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="callout callout-danger">
                                <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                            </div>
                            <div class="form-group">
                                <label>Nama SPMI <span>*</span></label>
                                <input type="text"
                                    class="form-control form-control-sm @error('nm_sistem_mutu_m') is-invalid @enderror"
                                    name="nm_sistem_mutu_m" value="{{ old('nm_sistem_mutu_m') }}" placeholder="Input SPMI"
                                    required>
                                @error('nm_sistem_mutu_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kode SPMI</label>
                                <input type="text"
                                    class="form-control form-control-sm @error('no_sistem_mutu_m') is-invalid @enderror"
                                    name="no_sistem_mutu_m" value="{{ old('no_sistem_mutu_m') }}" maxlength="30"
                                    placeholder="Nomor SPMI">
                                @error('no_sistem_mutu_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Deskripsi SPMI</label>
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
    <div class="col-md-8">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data SPMI</h3>
            </div>
            <div class="card-body">
                <div class="card-body table-responsive p-0" style="height: 460px;">
                    <table class="table table-head-fixed">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama SPMI</th>
                                <th>Kode SPMI</th>
                                <th>Deskripsi SPMI</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach ($MutuSistems as $sistem_mutu)
                            <tbody>
                                <tr id="hide{{ $sistem_mutu->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $sistem_mutu->nm_sistem_mutu }}</td>
                                    <td>{{ $sistem_mutu->no_sistem_mutu }}</td>
                                    <td>{{ $sistem_mutu->ket }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                            onclick="edit(this)"
                                            data-route="{{ route('sistem_mutu.edit', $sistem_mutu->id) }}"
                                            data-toggle="modal" data-target="#update">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script>
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
                let update = "{{ url('sistem_mutu') }}" + '/' + data.id;
                // console.log(update);
                $('.modal input[name=nm_sistem_mutu_m]').val(data.nm_sistem_mutu);
                $('.modal input[name=no_sistem_mutu_m]').val(data.no_sistem_mutu);
                $('.modal textarea[name=ket_m]').val(data.ket);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
