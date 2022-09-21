@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Periode AMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Periode AMI</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i> Add Periode
                        </a>
                        <a href="{{ route('ami_periode.index') }}" class="btn-sm btn-outline-danger"><i
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
                                <th class="text-center">Siklus</th>
                                <th>Sasaran Audit</th>
                                <th>Auditor 1</th>
                                <th>Auditor 2</th>
                                <th>Observer</th>
                                <th class="text-center">Jadwal Audit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AmiPeriodes as $AmiPeriode)
                                <tr id="hide{{ $AmiPeriode->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $AmiPeriode->mutu_periode->siklus }}</td>
                                    <td>{{ $AmiPeriode->unit_master->nm_unit }}</td>
                                    <td>{{ $AmiPeriode->dosen1->nama }}</td>
                                    <td>{{ $AmiPeriode->dosen2->nama }}</td>
                                    <td>{{ $AmiPeriode->dosen3->nama }}</td>
                                    <td class="text-center">{{ $AmiPeriode->tgl_periode_ami }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('ami_periode.edit', $AmiPeriode->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            <a target="_blank"
                                                href="{{ route('ami_periode.show', Crypt::encrypt($AmiPeriode->id)) }}"
                                                class="btn-sm btn-outline-danger" data-toggle="tooltip" title="View/Post"><i
                                                    class="fa fa-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="add">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Periode AMI</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="{{ route('ami_periode.store') }}" method="POST"
                            autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Siklus <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="mutu_periode_id"
                                            class="form-control form-control-sm select2 @error('mutu_periode_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($MutuPeriodes as $MutuPeriode)
                                                @if (old('mutu_periode_id') == $MutuPeriode->id)
                                                    <option value="{{ $MutuPeriode->id }}" selected>
                                                        {{ $MutuPeriode->siklus }}</option>
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
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Sasaran Audit <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="unit_master_id"
                                            class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            @foreach ($UnitMasters as $UnitMaster)
                                                @if (old('unit_master_id') == $UnitMaster->id)
                                                    <option value="{{ $UnitMaster->id }}" selected>
                                                        {{ $UnitMaster->nm_unit }}</option>
                                                @else
                                                    <option value="{{ $UnitMaster->id }}">{{ $UnitMaster->nm_unit }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('unit_master_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Jadwal AMI <span>*</span></label>
                                    <div class="col-sm-6">
                                        <div class="input-group date" id="periode_awal" data-target-input="nearest">
                                            <input type="text" name="tgl_periode_ami"
                                                class="form-control form-control-sm datetimepicker-input @error('tgl_periode_ami') is-invalid @enderror"
                                                value="{{ old('tgl_periode_ami') }}" data-target="#periode_awal"
                                                required>
                                            <div class="input-group-append" data-target="#periode_awal"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @error('tgl_periode_ami')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Auditee <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="auditee_id"
                                            class="form-control form-control-sm select2 @error('auditee_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($DosenMasters as $DosenMaster)
                                                @if (old('auditee_id') == $DosenMaster->id)
                                                    <option value="{{ $DosenMaster->id }}" selected>
                                                        {{ $DosenMaster->nama }}</option>
                                                @else
                                                    <option value="{{ $DosenMaster->id }}">{{ $DosenMaster->nama }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('auditee_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Auditor 1 <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="auditor1_id"
                                            class="form-control form-control-sm select2 @error('auditor1_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($DosenMasters as $DosenMaster)
                                                @if (old('auditor1_id') == $DosenMaster->id)
                                                    <option value="{{ $DosenMaster->id }}" selected>
                                                        {{ $DosenMaster->nama }}</option>
                                                @else
                                                    <option value="{{ $DosenMaster->id }}">{{ $DosenMaster->nama }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('auditor1_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Auditor 2 <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="auditor2_id"
                                            class="form-control form-control-sm select2 @error('auditor2_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($DosenMasters as $DosenMaster)
                                                @if (old('auditor2_id') == $DosenMaster->id)
                                                    <option value="{{ $DosenMaster->id }}" selected>
                                                        {{ $DosenMaster->nama }}</option>
                                                @else
                                                    <option value="{{ $DosenMaster->id }}">{{ $DosenMaster->nama }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('auditor2_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-sm-4 text-md-right">Observer <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="observer_id"
                                            class="form-control form-control-sm select2 @error('observer_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($DosenMasters as $DosenMaster)
                                                @if (old('observer_id') == $DosenMaster->id)
                                                    <option value="{{ $DosenMaster->id }}" selected>
                                                        {{ $DosenMaster->nama }}</option>
                                                @else
                                                    <option value="{{ $DosenMaster->id }}">{{ $DosenMaster->nama }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('observer_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-circle-check"></i> Submit
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

        <div class="modal fade" id="update">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Periode AMI</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-horizontal" action="" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="callout callout-danger">
                                <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Siklus <span>*</span></label>
                                <div class="col-sm-6">
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
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Sasaran Audit <span>*</span></label>
                                <div class="col-sm-6">
                                    <select name="unit_master_id_m"
                                        class="form-control form-control-sm select2 @error('unit_master_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @foreach ($UnitMasters as $UnitMaster)
                                            <option value="{{ $UnitMaster->id }}">{{ $UnitMaster->nm_unit }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_master_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Jadwal AMI <span>*</span></label>
                                <div class="col-sm-6">
                                    <div class="input-group date" id="periode_awal1" data-target-input="nearest">
                                        <input type="text" name="tgl_periode_ami_m"
                                            class="form-control form-control-sm datetimepicker-input @error('tgl_periode_ami_m') is-invalid @enderror"
                                            data-target="#periode_awal1" required>
                                        <div class="input-group-append" data-target="#periode_awal1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('tgl_periode_ami_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Auditee <span>*</span></label>
                                <div class="col-sm-6">
                                    <select name="auditee_id_m"
                                        class="form-control form-control-sm select2 @error('auditee_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($DosenMasters as $DosenMaster)
                                            @if (old('auditee_id_m') == $DosenMaster->id)
                                                <option value="{{ $DosenMaster->id }}" selected>
                                                    {{ $DosenMaster->nama }}</option>
                                            @else
                                                <option value="{{ $DosenMaster->id }}">{{ $DosenMaster->nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @error('auditee_id_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Auditor 1 <span>*</span></label>
                                <div class="col-sm-6">
                                    <select name="auditor1_id_m"
                                        class="form-control form-control-sm select2 @error('auditor1_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($DosenMasters as $DosenMaster)
                                            <option value="{{ $DosenMaster->id }}">{{ $DosenMaster->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('auditor1_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Auditor 2 <span>*</span></label>
                                <div class="col-sm-6">
                                    <select name="auditor2_id_m"
                                        class="form-control form-control-sm select2 @error('auditor2_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($DosenMasters as $DosenMaster)
                                            <option value="{{ $DosenMaster->id }}">{{ $DosenMaster->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('auditor2_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0 row">
                                <label class="col-sm-4 text-md-right">Observer <span>*</span></label>
                                <div class="col-sm-6">
                                    <select name="observer_id_m"
                                        class="form-control form-control-sm select2 @error('observer_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($DosenMasters as $DosenMaster)
                                            <option value="{{ $DosenMaster->id }}">{{ $DosenMaster->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('observer_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
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
@endsection
@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
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

        $(function() {

            $('#periode_awal').datetimepicker({
                format: 'YYYY/MM/DD'
            });

            $('#periode_awal1').datetimepicker({
                format: 'YYYY/MM/DD'
            });
        })

        function edit(el) {
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('ami_periode') }}" + '/' + data.id;
                //console.log(update);
                $('#update select[name=mutu_periode_id_m]').val(data.mutu_periode_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=unit_master_id_m]').val(data.unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update input[name=tgl_periode_ami_m]').val(data.tgl_periode_ami);
                $('#update select[name=auditee_id_m]').val(data.auditee_id).attr("selected", "selected").select2()
                    .trigger('change');
                $('#update select[name=auditor1_id_m]').val(data.auditor1_id).attr("selected", "selected").select2()
                    .trigger('change');
                $('#update select[name=auditor2_id_m]').val(data.auditor2_id).attr("selected", "selected").select2()
                    .trigger('change');
                $('#update select[name=observer_id_m]').val(data.observer_id).attr("selected", "selected").select2()
                    .trigger('change');
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
