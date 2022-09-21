@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Kinerja SPMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Periode Kinerja SPMI</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i> Add Kinerja
                        </a>
                        <a href="{{ route('monev_master_dokumen.index') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Siklus Kinerja</th>
                                <th>Unit Kerja</th>
                                <th>Kode Unit</th>
                                <th>SK Penetapan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MonevMasterDokumens as $MonevMasterDokumen)
                                <tr id="hide{{ $MonevMasterDokumen->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{ $MonevMasterDokumen->mutu_periode->siklus }} /
                                        {{ $MonevMasterDokumen->semester }}
                                    </td>
                                    <td>{{ $MonevMasterDokumen->unit_master->nm_unit }}</td>
                                    <td>{{ $MonevMasterDokumen->unit_master->no_unit }}</td>
                                    <td>{{ $MonevMasterDokumen->unit_master->no_penetapan_unit }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('monev_master_dokumen.edit', $MonevMasterDokumen->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            <a href="{{ route('show_monev', Crypt::encrypt($MonevMasterDokumen->id)) }}"
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
                            <h5 class="modal-title">Add Kinerja</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="{{ route('monev_master_dokumen.store') }}" method="POST"
                            autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Unit Kerja <span>*</span></label>
                                    <select name="unit_master_id"
                                        class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @foreach ($UnitMasters as $UnitMaster)
                                            @if (old('unit_master_id') == $UnitMaster->id)
                                                <option value="{{ $UnitMaster->id }}" selected>
                                                    {{ $UnitMaster->nm_unit }}
                                                </option>
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
                                <div class="form-group">
                                    <label>Siklus Kinerja <span>*</span></label>
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
                                    <label>Semester <span>*</span></label>
                                    <select name="semester"
                                        class="form-control form-control-sm select2 @error('semester') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @if (old('semester') == 'Ganjil')
                                            <option></option>
                                            <option value="Ganjil" selected>Ganjil</option>
                                            <option value="Genap">Genap</option>
                                        @elseif (old('semester') == 'Genap')
                                            <option></option>
                                            <option value="Ganjil">Ganjil</option>
                                            <option value="Genap" selected>Genap</option>
                                        @else
                                            <option></option>
                                            <option value="Ganjil">Ganjil</option>
                                            <option value="Genap">Genap</option>
                                        @endif
                                    </select>
                                    @error('semester')
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kinerja</h5>
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
                            <div class="form-group">
                                <label>Unit Kerja <span>*</span></label>
                                <select name="unit_master_id_m"
                                    class="form-control form-control-sm select2 @error('unit_master_id_m') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    @foreach ($UnitMasters as $UnitMaster)
                                        @if (old('unit_master_id_m') == $UnitMaster->id)
                                            <option value="{{ $UnitMaster->id }}" selected>{{ $UnitMaster->nm_unit }}
                                            </option>
                                        @else
                                            <option value="{{ $UnitMaster->id }}">{{ $UnitMaster->nm_unit }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('unit_master_id_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Siklus Kinerja <span>*</span></label>
                                <select name="mutu_periode_id_m"
                                    class="form-control form-control-sm select2 @error('mutu_periode_id_m') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    @foreach ($MutuPeriodes as $MutuPeriode)
                                        @if (old('mutu_periode_id_m') == $MutuPeriode->id)
                                            <option value="{{ $MutuPeriode->id }}" selected>
                                                {{ $MutuPeriode->siklus }}
                                            </option>
                                        @else
                                            <option value="{{ $MutuPeriode->id }}">{{ $MutuPeriode->siklus }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('mutu_periode_id_m')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Semester <span>*</span></label>
                                <select name="semester_m"
                                    class="form-control form-control-sm select2 @error('semester_m') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    @if (old('semester_m') == 'Ganjil')
                                        <option></option>
                                        <option value="Ganjil" selected>Ganjil</option>
                                        <option value="Genap">Genap</option>
                                    @elseif (old('semester_m') == 'Genap')
                                        <option></option>
                                        <option value="Ganjil">Ganjil</option>
                                        <option value="Genap" selected>Genap</option>
                                    @else
                                        <option></option>
                                        <option value="Ganjil">Ganjil</option>
                                        <option value="Genap">Genap</option>
                                    @endif
                                </select>
                                @error('semester_m')
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
                let update = "{{ url('monev_master_dokumen') }}" + '/' + data.id;
                //console.log(update);
                $('#update select[name=mutu_periode_id_m]').val(data.mutu_periode_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=semester_m]').val(data.semester).attr("selected", "selected").select2()
                    .trigger('change');
                $('#update select[name=unit_master_id_m]').val(data.unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
