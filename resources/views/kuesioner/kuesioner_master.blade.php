@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Kuesioner Master')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header ">
                <h3 class="card-title">Kuesioner SPMI</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i> Add Kuesioner</a>
                        <a href="{{ route('kuesioner.index') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Instrumen Akreditasi</th>
                                <th>Kode</th>
                                <th>Nama Survey</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($KuesionerMasters as $KuesionerMaster)
                                <tr id="hide{{ $KuesionerMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $KuesionerMaster->monev_master->monev_kategori->nm_jenis_monev }}</td>
                                    <td>{{ $KuesionerMaster->monev_master->no_monev }}</td>
                                    <td>{{ $KuesionerMaster->monev_master->nm_monev }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('kuesioner.edit', $KuesionerMaster->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            <a href="{{ route('kuesioner_detail.show', Crypt::encrypt($KuesionerMaster->id)) }}"
                                                class="btn-sm btn-outline-primary" data-toggle="tooltip"
                                                title="View/Post"><i class="fa fa-table-columns"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="add">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Kuesioner</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('kuesioner.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Evaluasi Kinerja<span>*</span></label>
                                    <select name="unit_master_id"
                                        class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        {{-- @foreach ($UnitMasters as $UnitMaster) --}}
                                        <option value="{{ $UnitMaster->id }}" selected>
                                            {{ $UnitMaster->nm_unit }}
                                        </option>
                                        {{-- @endforeach --}}
                                    </select>
                                    @error('unit_master_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Monev Kategori <span>*</span></label>
                                    <select name="monev_master_id"
                                        class="form-control form-control-sm select2 @error('monev_master_id') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($MonevMasters as $MonevMaster)
                                            @if (old('monev_master_id') == $MonevMaster->id)
                                                <option value="{{ $MonevMaster->id }}" selected>
                                                    {{ $MonevMaster->nm_monev }}</option>
                                            @else
                                                <option value="{{ $MonevMaster->id }}">{{ $MonevMaster->nm_monev }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('monev_master_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-check-circle"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="fa fa-cancel"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="update">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kuesioner</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" autocomplete="off">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row">
                                    <label>Palaksana Survey <span>*</span></label>
                                    <select name="unit_master_id_m"
                                        class="form-control form-control-sm select2 @error('unit_master_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        {{-- @foreach ($UnitMasters as $UnitMaster) --}}
                                        <option value="{{ $UnitMaster->id }}" selected>{{ $UnitMaster->nm_unit }}
                                        </option>
                                        {{-- @endforeach --}}
                                    </select>
                                    @error('unit_master_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label>Monev Kategori <span>*</span></label>
                                    <select name="monev_master_id_m"
                                        class="form-control form-control-sm select2 @error('monev_master_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($MonevMasters as $MonevMaster)
                                            <option value="{{ $MonevMaster->id }}">{{ $MonevMaster->nm_monev }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('monev_master_id_m')
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
                                <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">
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
                let update = "{{ url('kuesioner') }}" + '/' + data.id;
                // console.log(update);
                $('#update select[name=monev_master_id_m]').val(data.monev_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=unit_master_id_m]').val(data.unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
