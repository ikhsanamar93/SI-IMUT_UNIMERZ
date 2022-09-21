@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Data Kabupaten')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultMaroon"></div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Input Kabupaten</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('data_master') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>
            <form class="form-horizontal" action="{{ route('simpan_kabupaten') }}" method="POST"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Provinsi *</label>
                        <input type="text" name="nm_provinsi"
                            class="form-control form-control-sm @error('nm_provinsi') is-invalid @enderror"
                            value="{{ $ProvinsiMaster->nm_provinsi }}" style="background-color: white"
                            placeholder="Provinsi" readonly>
                        @error('nm_provinsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Kabupaten <span>*</span></label>
                        <input type="text" name="nm_kabupaten"
                            class="form-control form-control-sm @error('nm_kabupaten') is-invalid @enderror"
                            value="{{ old('nm_kabupaten') }}" placeholder="Nama Kabupaten" required>
                        @error('nm_kabupaten')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kode Kabupaten *</label>
                        <input type="text" name="no_kabupaten"
                            class="form-control form-control-sm @error('no_kabupaten') is-invalid @enderror"
                            value="{{ old('no_kabupaten') }}" placeholder="Kode Kabupaten" maxlength="30">
                        @error('no_kabupaten')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" name="provinsi_master_id" value="{{ $ProvinsiMaster->no_provinsi }}" readonly>
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
                            <h5 class="modal-title">Edit Kabupaten</h5>
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
                                    <label>Provinsi *</label>
                                    <input type="text" name="nm_provinsi_m"
                                        class="form-control form-control-sm @error('nm_provinsi_m') is-invalid @enderror"
                                        value="{{ $ProvinsiMaster->nm_provinsi }}" style="background-color: white"
                                        placeholder="Provinsi" readonly>
                                    @error('nm_provinsi_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Kabupaten <span>*</span></label>
                                    <input type="text" name="nm_kabupaten_m"
                                        class="form-control form-control-sm @error('nm_kabupaten_m') is-invalid @enderror"
                                        value="{{ old('nm_kabupaten_m') }}" placeholder="Nama Kabupaten" required>
                                    @error('nm_kabupaten_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Kabupaten </label>
                                    <input type="text" name="no_kabupaten_m"
                                        class="form-control form-control-sm @error('no_kabupaten_m') is-invalid @enderror"
                                        value="{{ old('no_kabupaten_m') }}" placeholder="Kode Kabupaten" maxlength="30">
                                    @error('no_kabupaten_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="provinsi_master_id"
                                    value="{{ $ProvinsiMaster->no_provinsi }}" readonly>
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
                <h3 class="card-title">Data Kabupaten</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Kabupaten</th>
                                <th>Kode Kabupaten</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($KabupatenMasters as $KabupatenMaster)
                                <tr id="hide{{ $KabupatenMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $KabupatenMaster->nm_kabupaten }}</td>
                                    <td>{{ $KabupatenMaster->no_kabupaten }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                            onclick="edit(this)"
                                            data-route="{{ route('edit_kabupaten', $KabupatenMaster->id) }}"
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
                let update = "{{ url('update_kabupaten') }}" + '/' + data.id;
                //console.log(update);
                $('.modal input[name=nm_kabupaten_m]').val(data.nm_kabupaten);
                $('.modal input[name=no_kabupaten_m]').val(data.no_kabupaten);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
