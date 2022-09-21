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
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Periode Kinerja</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i> Add Dokumen
                        </a>
                        <a href="{{ route('mutu_master_dokumen.index') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Periode Kinerja</th>
                                <th>Unit Kerja</th>
                                <th>Kode Unit</th>
                                <th>SK Penetapan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MutuMasterDokumens as $MutuMasterDokumen)
                                <tr id="hide{{ $MutuMasterDokumen->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $MutuMasterDokumen->mutu_periode->siklus }}</td>
                                    <td>{{ $MutuMasterDokumen->unit_master->nm_unit }}</td>
                                    <td>{{ $MutuMasterDokumen->unit_master->no_unit }}</td>
                                    <td>{{ $MutuMasterDokumen->unit_master->no_penetapan_unit }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn-sm btn-outline-success" onclick="edit(this)"
                                            data-route="{{ route('mutu_master_dokumen.edit', $MutuMasterDokumen->id) }}"
                                            data-toggle="modal" data-target="#update">
                                            <i class="fa fa-edit fa-fw"></i>
                                        </a>
                                        <a href="{{ route('mutu_detail_dokumen.show', Crypt::encrypt($MutuMasterDokumen->id)) }}"
                                            class="btn-sm btn-outline-primary" data-toggle="tooltip" title="View/Post"><i
                                                class="fa fa-table-columns"></i></a>
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
                            <h5 class="modal-title">Add Dokumen Mutu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="{{ route('mutu_master_dokumen.store') }}" method="POST"
                            autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Periode Kinerja <span>*</span></label>
                                    <select name="mutu_periode_id"
                                        class="form-control form-control-sm select2 @error('mutu_periode_id') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($MutuPeriodes as $MutuPeriode)
                                            @if (old('mutu_periode_id') == $MutuPeriode->id)
                                                <option value="{{ $MutuPeriode->id }}" selected>
                                                    {{ $MutuPeriode->siklus }}
                                                </option>
                                            @else
                                                <option value="{{ $MutuPeriode->id }}">{{ $MutuPeriode->siklus }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('mutu_periode_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Unit Kerja <span>*</span></label>
                                    <select name="unit_master_id"
                                        class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @foreach ($UnitMasters as $UnitMaster)
                                            <option value="{{ $UnitMaster->id }}" selected>{{ $UnitMaster->nm_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_master_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-check-circle"></i> Save
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
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
                            <h5 class="modal-title">Edit Dokumen Mutu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Periode Kinerja <span>*</span></label>
                                    <select name="mutu_periode_id_m"
                                        class="form-control form-control-sm select2 @error('mutu_periode_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($MutuPeriodes as $MutuPeriode)
                                            <option value="{{ $MutuPeriode->id }}">{{ $MutuPeriode->siklus }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mutu_periode_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Unit Kerja <span>*</span></label>
                                    <select name="unit_master_id_m"
                                        class="form-control form-control-sm select2 @error('unit_master_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @foreach ($UnitMasters as $UnitMaster)
                                            <option value="{{ $UnitMaster->id }}" selected>{{ $UnitMaster->nm_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_master_id_m')
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
                let update = "{{ url('mutu_master_dokumen') }}" + '/' + data.id;
                //console.log(update);
                $('.modal select[name=unit_master_id_m]').val(data.unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('.modal select[name=mutu_periode_id_m]').val(data.mutu_periode_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
