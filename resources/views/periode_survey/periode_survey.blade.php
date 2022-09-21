@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Periode Survey')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Survey Periode</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i> Add Periode
                        </a>
                        <a href="{{ route('show_periode_survey', Crypt::encrypt($MonevMasterDokumens->unit_master_id)) }}"
                            class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Siklus SPMI</th>
                                <th>Surveyor</th>
                                <th>Survey Kategori</th>
                                <th class="text-center">Responden</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SurveyPeriodes as $SurveyPeriode)
                                <tr id="hide{{ $SurveyPeriode->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $SurveyPeriode->mutu_periode->siklus }} /
                                        {{ $SurveyPeriode->semester }}</td>
                                    <td>{{ $SurveyPeriode->unit_master->nm_unit }}</td>
                                    <td>{{ $SurveyPeriode->kuesioner_master->monev_master->nm_monev }}</td>
                                    <td class="text-center">
                                        @if ($SurveyPeriode->responden_mahasiswa == 1)
                                            {{-- <span class="badge badge-info">Mhs</span> --}}
                                            <a href="{{ route('rekap_survey_kategori', [Crypt::encrypt($SurveyPeriode->id), 1]) }}"
                                                class="badge badge-info">Mhs</a>
                                        @endif
                                        @if ($SurveyPeriode->responden_dosen == 1)
                                            <a href="{{ route('rekap_survey_kategori', [Crypt::encrypt($SurveyPeriode->id), 2]) }}"
                                                class="badge badge-warning">Dosen</a>
                                        @endif
                                        @if ($SurveyPeriode->responden_tendik == 1)
                                            <a href="{{ route('rekap_survey_kategori', [Crypt::encrypt($SurveyPeriode->id), 3]) }}"
                                                class="badge badge-primary">Tendik</a>
                                        @endif
                                        @if ($SurveyPeriode->responden_alumni == 1)
                                            <a href="{{ route('rekap_survey_kategori', [Crypt::encrypt($SurveyPeriode->id), 4]) }}"
                                                class="badge badge-dark">Alumni</a>
                                        @endif
                                        @if ($SurveyPeriode->responden_mitra == 1)
                                            <a href="{{ route('rekap_survey_kategori', [Crypt::encrypt($SurveyPeriode->id), 5]) }}"
                                                class="badge badge-danger">Mitra</a>
                                        @endif
                                    </td>
                                    </td>
                                    <td class="text-center">
                                        @if ($SurveyPeriode->status == 1)
                                            <span class="badge bg-danger">True</span>
                                        @else
                                            <span class="badge bg-dark">False</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('survey_periode.edit', $SurveyPeriode->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            <a href="{{ route('rekap_survey', Crypt::encrypt($SurveyPeriode->id)) }}"
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
                            <h5 class="modal-title">Add Survey Periode</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="{{ route('survey_periode.store') }}" method="POST"
                            autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" class="form-control form-control-sm"
                                        name="monev_master_dokumen_id" value="{{ $MonevMasterDokumens->id }}" readonly
                                        required>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Survey Periode <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="mutu_periode_id"
                                            class="form-control form-control-sm select2 @error('mutu_periode_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            @foreach ($MutuPeriodes as $MutuPeriode)
                                                <option value="{{ $MutuPeriode->id }}" selected>
                                                    {{ $MutuPeriode->siklus }}
                                                </option>
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
                                    <label class="col-sm-4 text-md-right">Surveyor <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="unit_master_id"
                                            class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            @foreach ($UnitMasters as $UnitMaster)
                                                <option value="{{ $UnitMaster->id }}" selected>
                                                    {{ $UnitMaster->nm_unit }}
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
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Survey Kategori <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="kuesioner_master_id"
                                            class="form-control form-control-sm select2 @error('kuesioner_master_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($KuesionerMasters as $KuesionerMaster)
                                                @if (old('kuesioner_master_id') == $KuesionerMaster->id)
                                                    <option value="{{ $KuesionerMaster->id }}" selected>
                                                        {{ $KuesionerMaster->monev_master->nm_monev }}</option>
                                                @else
                                                    <option value="{{ $KuesionerMaster->id }}">
                                                        {{ $KuesionerMaster->monev_master->nm_monev }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('kuesioner_master_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Semester <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="semester"
                                            class="form-control form-control-sm select2 @error('semester') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option value="{{ $MonevMasterDokumens->semester }}" selected>
                                                {{ $MonevMasterDokumens->semester }}
                                            </option>
                                        </select>
                                        @error('semester')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Responden *</label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input name="responden_mahasiswa" value="1"
                                                class="form-check-input @error('responden_mahasiswa') is-invalid @enderror"
                                                value="{{ old('responden_mahasiswa') }}" type="checkbox">
                                            <label class="form-check-label">Mahasiswa</label>
                                            @error('responden_mahasiswa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-check">
                                            <input name="responden_dosen" value="1"
                                                class="form-check-input @error('responden_dosen') is-invalid @enderror"
                                                value="{{ old('responden_dosen') }}" type="checkbox">
                                            <label class="form-check-label">Dosen</label>
                                            @error('responden_dosen')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-check">
                                            <input name="responden_tendik" value="1"
                                                class="form-check-input @error('responden_tendik') is-invalid @enderror"
                                                value="{{ old('responden_tendik') }}" type="checkbox">
                                            <label class="form-check-label">Tendik</label>
                                            @error('responden_tendik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-check">
                                            <input name="responden_alumni" value="1"
                                                class="form-check-input @error('responden_alumni') is-invalid @enderror"
                                                value="{{ old('responden_alumni') }}" type="checkbox">
                                            <label class="form-check-label">Alumni</label>
                                            @error('responden_alumni')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-check">
                                            <input name="responden_mitra" value="1"
                                                class="form-check-input @error('responden_mitra') is-invalid @enderror"
                                                value="{{ old('responden_mitra') }}" type="checkbox">
                                            <label class="form-check-label">Stakeholder/Mitra</label>
                                            @error('responden_mitra')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Status Periode </label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input name="status" value="1"
                                                class="form-check-input @error('status') is-invalid @enderror"
                                                value="{{ old('status') }}" type="checkbox">
                                            <label class="form-check-label">Periode Aktif</label>
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- <input type="text" name="responden_kategori" value="" class="form-control @error('responden_kategori') is-invalid @enderror" readonly required> --}}
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
                        <h5 class="modal-title">Edit Dokumen Audit</h5>
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
                                <input type="hidden" class="form-control form-control-sm"
                                    name="monev_master_dokumen_id_m" value="{{ $MonevMasterDokumens->id }}" readonly
                                    required>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Survey Periode <span>*</span></label>
                                <div class="col-sm-6">
                                    <select name="mutu_periode_id_m"
                                        class="form-control form-control-sm select2 @error('mutu_periode_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        @foreach ($MutuPeriodes as $MutuPeriode)
                                            <option value="{{ $MutuPeriode->id }}" selected>
                                                {{ $MutuPeriode->siklus }}
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
                                <label class="col-sm-4 text-md-right">Surveyor <span>*</span></label>
                                <div class="col-sm-6">
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
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Kuesioner <span>*</span></label>
                                <div class="col-sm-6">
                                    <select name="kuesioner_master_id_m"
                                        class="form-control form-control-sm select2 @error('kuesioner_master_id_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option></option>
                                        @foreach ($KuesionerMasters as $KuesionerMaster)
                                            <option value="{{ $KuesionerMaster->id }}">
                                                {{ $KuesionerMaster->monev_master->nm_monev }}</option>
                                        @endforeach
                                    </select>
                                    @error('kuesioner_master_id_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Semester <span>*</span></label>
                                <div class="col-sm-6">
                                    <select name="semester_m"
                                        class="form-control form-control-sm select2 @error('semester_m') is-invalid @enderror"
                                        data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                        <option value="{{ $MonevMasterDokumens->semester }}" selected>
                                            {{ $MonevMasterDokumens->semester }}
                                        </option>
                                    </select>
                                    @error('semester_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Responden *</label>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input name="responden_mahasiswa_m" id="responden_mahasiswa_m" value="1"
                                            class="form-check-input @error('responden_mahasiswa_m') is-invalid @enderror"
                                            value="{{ old('responden_mahasiswa_m') }}" type="checkbox">
                                        <label class="form-check-label">Mahasiswa</label>
                                        @error('responden_mahasiswa_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-check">
                                        <input name="responden_dosen_m" id="responden_dosen_m" value="1"
                                            class="form-check-input @error('responden_dosen_m') is-invalid @enderror"
                                            value="{{ old('responden_dosen_m') }}" type="checkbox">
                                        <label class="form-check-label">Dosen</label>
                                        @error('responden_dosen_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-check">
                                        <input name="responden_tendik_m" id="responden_tendik_m" value="1"
                                            class="form-check-input @error('responden_tendik_m') is-invalid @enderror"
                                            value="{{ old('responden_tendik_m') }}" type="checkbox">
                                        <label class="form-check-label">Tendik</label>
                                        @error('responden_tendik_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-check">
                                        <input name="responden_alumni_m" id="responden_alumni_m" value="1"
                                            class="form-check-input @error('responden_alumni_m') is-invalid @enderror"
                                            value="{{ old('responden_alumni_m') }}" type="checkbox">
                                        <label class="form-check-label">Alumni</label>
                                        @error('responden_alumni_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-check">
                                        <input name="responden_mitra_m" id="responden_mitra_m" value="1"
                                            class="form-check-input @error('responden_mitra_m') is-invalid @enderror"
                                            value="{{ old('responden_mitra_m') }}" type="checkbox">
                                        <label class="form-check-label">Stakeholder/Mitra</label>
                                        @error('responden_mitra_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 text-md-right">Status Periode</label>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input name="status_m" id="status_m" value="1"
                                            class="form-check-input @error('status_m') is-invalid @enderror"
                                            value="{{ old('status_m') }}" type="checkbox">
                                        <label class="form-check-label">Periode Aktif</label>
                                        @error('status_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
            var x = document.getElementById("status_m");
            var m = document.getElementById("responden_mahasiswa_m");
            var d = document.getElementById("responden_dosen_m");
            var t = document.getElementById("responden_tendik_m");
            var a = document.getElementById("responden_alumni_m");
            var mt = document.getElementById("responden_mitra_m");
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('survey_periode') }}" + '/' + data.id;
                //console.log(update);
                $('#update select[name=mutu_periode_id_m]').val(data.mutu_periode_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=unit_master_id_m]').val(data.unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=kuesioner_master_id_m]').val(data.kuesioner_master_id).attr("selected",
                    "selected").select2().trigger('change');
                $('#update select[name=semester_m]').val(data.semester).attr("selected", "selected").select2()
                    .trigger('change');
                if (data.responden_mahasiswa == 1) {
                    m.checked = true;
                } else {
                    m.checked = false;
                };
                if (data.responden_dosen == 1) {
                    d.checked = true;
                } else {
                    d.checked = false;
                }
                if (data.responden_tendik == 1) {
                    t.checked = true;
                } else {
                    t.checked = false;
                }
                if (data.responden_alumni == 1) {
                    a.checked = true;
                } else {
                    a.checked = false;
                }
                if (data.responden_mitra == 1) {
                    mt.checked = true;
                } else {
                    mt.checked = false;
                }
                if (data.status == 1) {
                    x.checked = true;
                } else {
                    x.checked = false;
                }
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
