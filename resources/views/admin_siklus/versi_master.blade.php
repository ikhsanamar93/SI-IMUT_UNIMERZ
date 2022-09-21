@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Versi SPMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Input Versi Dokumen</h3>
            </div>
            <form class="form-horizontal" action="{{ route('master_versi.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Nama Versi SPMI <span>*</span></label>
                        <input type="text" name="nm_versi"
                            class="form-control form-control-sm @error('nm_versi') is-invalid @enderror"
                            value="{{ old('nm_versi') }}" placeholder="Nama Versi SPMI" required>
                        @error('nm_versi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kode Versi SPMI <span>*</span></label>
                        <input type="text" name="no_versi"
                            class="form-control form-control-sm @error('no_versi') is-invalid @enderror"
                            value="{{ old('no_versi') }}" placeholder="Kode Versi SPMI" maxlength="30" required>
                        @error('no_versi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>No. Pengesahan </label>
                        <input type="text" name="no_pengesahan_versi"
                            class="form-control form-control-sm @error('no_pengesahan_versi') is-invalid @enderror"
                            value="{{ old('no_pengesahan_versi') }}" placeholder="Nomor Pengesahan" maxlength="30">
                        @error('no_pengesahan_versi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label>Deskripsi </label>
                        <textarea class="form-control form-control-sm @error('ket') is-invalid @enderror" rows="4" name="ket"
                            placeholder="Deskripsi Versi SPMI ...">{{ old('ket') }}</textarea>
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
                            <h5 class="modal-title">Edit Versi Dokumen</h5>
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
                                    <label>Nama Versi SPMI <span>*</span></label>
                                    <input type="text" name="nm_versi_m"
                                        class="form-control form-control-sm @error('nm_versi_m') is-invalid @enderror"
                                        value="{{ old('nm_versi_m') }}" placeholder="Nama Versi SPMI" required>
                                    @error('nm_versi_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Versi SPMI <span>*</span></label>
                                    <input type="text" name="no_versi_m"
                                        class="form-control form-control-sm @error('no_versi_m') is-invalid @enderror"
                                        value="{{ old('no_versi_m') }}" placeholder="Kode Versi SPMI" maxlength="30"
                                        required>
                                    @error('no_versi_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No. Pengesahan </label>
                                    <input type="text" name="no_pengesahan_versi_m"
                                        class="form-control form-control-sm @error('no_pengesahan_versi_m') is-invalid @enderror"
                                        value="{{ old('no_pengesahan_versi_m') }}" placeholder="Nomor Pengesahan"
                                        maxlength="30">
                                    @error('no_pengesahan_versi_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Deskripsi </label>
                                    <textarea class="form-control form-control-sm @error('ket_m') is-invalid @enderror" rows="4" name="ket_m"
                                        placeholder="Deskripsi Versi SPMI ...">{{ old('ket_m') }}</textarea>
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
                <h3 class="card-title">Data Versi Dokumen SPMI</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Versi</th>
                                <th>Kode Versi</th>
                                <th>No. Pengesahan</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($VersiMasters as $VersiMaster)
                                <tr id="hide{{ $VersiMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $VersiMaster->nm_versi }}</td>
                                    <td>{{ $VersiMaster->no_versi }}</td>
                                    <td>{{ $VersiMaster->no_pengesahan_versi }}</td>
                                    {{-- <td>{{$VersiMaster->ket}}</td> --}}
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('master_versi.edit', $VersiMaster->id) }}"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
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
                let update = "{{ url('master_versi') }}" + '/' + data.id;
                //console.log(update);
                $('.modal input[name=nm_versi_m]').val(data.nm_versi);
                $('.modal input[name=no_versi_m]').val(data.no_versi);
                $('.modal input[name=no_pengesahan_versi_m]').val(data.no_pengesahan_versi);
                $('.modal textarea[name=ket_m]').val(data.ket);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
