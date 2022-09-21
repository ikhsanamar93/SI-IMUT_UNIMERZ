@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Periode Mutu')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Input Periode Mutu</h3>
            </div>
            <form class="form-horizontal" action="{{ route('periode_mutu.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Siklus Mutu <span>*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" name="siklus"
                                class="form-control form-control-sm @error('siklus') is-invalid @enderror"
                                value="{{ old('siklus') }}" data-inputmask='"mask": "9999-9999"' data-mask required>
                            @error('siklus')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Periode Awal <span>*</span></label>
                        <div class="input-group date" id="periode_awal" data-target-input="nearest">
                            <input type="text" name="tgl_awal"
                                class="form-control form-control-sm datetimepicker-input @error('tgl_awal') is-invalid @enderror"
                                value="{{ old('tgl_awal') }}" data-target="#periode_awal" required>
                            <div class="input-group-append" data-target="#periode_awal" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @error('tgl_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Periode Akhir <span>*</span></label>
                        <div class="input-group date" id="periode_akhir" data-target-input="nearest">
                            <input type="text" name="tgl_akhir"
                                class="form-control form-control-sm datetimepicker-input @error('tgl_akhir') is-invalid @enderror"
                                value="{{ old('tgl_akhir') }}" data-target="#periode_akhir" required>
                            <div class="input-group-append" data-target="#periode_akhir" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            @error('tgl_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-check">
                        <input name="akreditasi" value="1"
                            class="form-check-input @error('akreditasi') is-invalid @enderror"
                            value="{{ old('akreditasi') }}" type="checkbox" checked>
                        <label class="form-check-label">Periode Akreditasi</label>
                        @error('akreditasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input name="spmi" value="1" class="form-check-input @error('spmi') is-invalid @enderror"
                            value="{{ old('spmi') }}" type="checkbox" checked>
                        <label class="form-check-label">Periode SPMI</label>
                        @error('spmi')
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
                            <h5 class="modal-title">Edit Periode Mutu</h5>
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
                                    <label>Siklus Mutu <span>*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" name="siklus_m"
                                            class="form-control form-control-sm @error('siklus_m') is-invalid @enderror"
                                            value="{{ old('siklus_m') }}" data-inputmask='"mask": "9999-9999"'
                                            data-mask required>
                                        @error('siklus_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Periode Awal <span>*</span></label>
                                    <div class="input-group date" id="periode_awal_m" data-target-input="nearest">
                                        <input type="text" name="tgl_awal_m"
                                            class="form-control form-control-sm datetimepicker-input @error('tgl_awal_m') is-invalid @enderror"
                                            value="{{ old('tgl_awal_m') }}" data-target="#periode_awal_m" required>
                                        <div class="input-group-append" data-target="#periode_awal_m"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('tgl_awal_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Periode Akhir <span>*</span></label>
                                    <div class="input-group date" id="periode_akhir_m" data-target-input="nearest">
                                        <input type="text" name="tgl_akhir_m"
                                            class="form-control form-control-sm datetimepicker-input @error('tgl_akhir_m') is-invalid @enderror"
                                            value="{{ old('tgl_akhir_m') }}" data-target="#periode_akhir_m" required>
                                        <div class="input-group-append" data-target="#periode_akhir_m"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        @error('tgl_akhir_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input name="akreditasi_m" id="akreditasi_m" value="1"
                                        class="form-check-input @error('akreditasi_m') is-invalid @enderror"
                                        value="{{ old('akreditasi_m') }}" type="checkbox">
                                    <label class="form-check-label">Periode Akreditasi</label>
                                    @error('akreditasi_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-check">
                                    <input name="spmi_m" id="spmi_m" value="1"
                                        class="form-check-input @error('spmi_m') is-invalid @enderror"
                                        value="{{ old('spmi_m') }}" type="checkbox">
                                    <label class="form-check-label">Periode SPMI</label>
                                    @error('spmi_m')
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
                <h3 class="card-title">Data Periode Mutu</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Siklus</th>
                                <th class="text-center">Periode</th>
                                <th class="text-center">Akreditasi</th>
                                <th class="text-center">SPMI</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MutuPeriodes as $MutuPeriode)
                                <tr id="hide{{ $MutuPeriode->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $MutuPeriode->siklus }}</td>
                                    <td class="text-center">{{ $MutuPeriode->tgl_awal }} /
                                        {{ $MutuPeriode->tgl_akhir }}</td>
                                    <td class="text-center">
                                        @if ($MutuPeriode->akreditasi == 1)
                                            <span class="badge bg-danger">True</span>
                                        @else
                                            <span class="badge bg-dark">False</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($MutuPeriode->spmi == 1)
                                            <span class="badge bg-danger">True</span>
                                        @else
                                            <span class="badge bg-dark">False</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('periode_mutu.edit', $MutuPeriode->id) }}"
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
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(function() {
            $('[data-mask]').inputmask()

            $('#periode_awal').datetimepicker({
                format: 'YYYY/MM/DD'
            });

            $('#periode_akhir').datetimepicker({
                format: 'YYYY/MM/DD'
            });

            $('#periode_awal_m').datetimepicker({
                format: 'YYYY/MM/DD'
            });

            $('#periode_akhir_m').datetimepicker({
                format: 'YYYY/MM/DD'
            });
        })

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
            var x = document.getElementById("akreditasi_m");
            var y = document.getElementById("spmi_m");
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('periode_mutu') }}" + '/' + data.id;
                //console.log(update);
                $('.modal input[name=siklus_m]').val(data.siklus);
                $('.modal input[name=tgl_awal_m]').val(data.tgl_awal);
                $('.modal input[name=tgl_akhir_m]').val(data.tgl_akhir);
                if (data.akreditasi == 1) {
                    x.checked = true;
                } else {
                    x.checked = false;
                }
                if (data.spmi == 1) {
                    y.checked = true;
                } else {
                    y.checked = false;
                }
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
