@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Dokumen SPMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Dokumen SPMI</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        @can('admin')
                            <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                                <i class="fa fa-plus"></i> Add Dokumen
                            </a>
                        @endcan
                        <a href="{{ route('spmi.index') }}" class="btn-sm btn-outline-danger"><i
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
                                <th>Sistem SPMI</th>
                                <th>Versi</th>
                                <th>Unit Kerja</th>
                                <th>Uraian Dokumen</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SpmiMasterDokumens as $SpmiMasterDokumen)
                                <tr id="hide{{ $SpmiMasterDokumen->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $SpmiMasterDokumen->mutu_sistem->nm_sistem_mutu }}</td>
                                    <td>{{ $SpmiMasterDokumen->versi_master->nm_versi }}</td>
                                    <td>{{ $SpmiMasterDokumen->unit_master->nm_unit }}</td>
                                    <td>{{ $SpmiMasterDokumen->nm_spmi }}</td>
                                    <td class="text-center">
                                        @if ($SpmiMasterDokumen->status_spmi == 1)
                                            <span class="badge bg-danger">True</span>
                                        @else
                                            <span class="badge bg-dark">False</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            @can('admin')
                                                <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                    onclick="edit(this)"
                                                    data-route="{{ route('spmi.edit', $SpmiMasterDokumen->id) }}"
                                                    data-toggle="modal" data-target="#update">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                </a>
                                            @endcan
                                            <a href="{{ route('spmi_dokumen.show', Crypt::encrypt($SpmiMasterDokumen->id)) }}"
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
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Dokumen SPMI</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('spmi.store') }}" method="post" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Sistem Mutu <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="mutu_sistem_id"
                                            class="form-control form-control-sm select2 @error('mutu_sistem_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($MutuSistems as $MutuSistem)
                                                @if (old('mutu_sistem_id') == $MutuSistem->id)
                                                    <option value="{{ $MutuSistem->id }}" selected>
                                                        {{ $MutuSistem->nm_sistem_mutu }}</option>
                                                @else
                                                    <option value="{{ $MutuSistem->id }}">
                                                        {{ $MutuSistem->nm_sistem_mutu }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('mutu_sistem_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Versi SPMI <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="versi_master_id"
                                            class="form-control form-control-sm select2 @error('versi_master_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($VersiMasters as $VersiMaster)
                                                @if (old('versi_master_id') == $VersiMaster->id)
                                                    <option value="{{ $VersiMaster->id }}" selected>
                                                        {{ $VersiMaster->nm_versi }}</option>
                                                @else
                                                    <option value="{{ $VersiMaster->id }}">
                                                        {{ $VersiMaster->nm_versi }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('versi_master_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Unit Kerja <span>*</span></label>
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
                                    <label class="col-sm-4 text-md-right">Uraian Dokumen <span>*</span></label>
                                    <div class="col-sm-6">
                                        <input name="nm_spmi" type="text"
                                            class="form-control form-control-sm @error('nm_spmi') is-invalid @enderror"
                                            value="{{ old('nm_spmi') }}" placeholder="Input SPMI" required>
                                        @error('nm_spmi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Kode Dokumen</label>
                                    <div class="col-sm-6">
                                        <input name="no_spmi" type="text"
                                            class="form-control form-control-sm @error('no_spmi') is-invalid @enderror"
                                            value="{{ old('no_spmi') }}" placeholder="Nomor SPMI">
                                        @error('no_spmi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-sm-4 text-md-right">Status Dokumen SPMI</label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input name="status_spmi" id="status_spmi" value="1"
                                                class="form-check-input @error('status_spmi') is-invalid @enderror"
                                                type="checkbox">
                                            <label class="form-check-label">Aktif</label>
                                            @error('status_spmi')
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
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Dokumen SPMI</h5>
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
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Sistem Mutu <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="mutu_sistem_id_m"
                                            class="form-control form-control-sm select2 @error('mutu_sistem_id_m') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($MutuSistems as $MutuSistem)
                                                <option value="{{ $MutuSistem->id }}">
                                                    {{ $MutuSistem->nm_sistem_mutu }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mutu_sistem_id_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Versi SPMI <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="versi_master_id_m"
                                            class="form-control form-control-sm select2 @error('versi_master_id_m') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($VersiMasters as $VersiMaster)
                                                <option value="{{ $VersiMaster->id }}">{{ $VersiMaster->nm_versi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('versi_master_id_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Unit Kerja <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="unit_master_id_m"
                                            class="form-control form-control-sm select2 @error('unit_master_id_m') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            @foreach ($UnitMasters as $UnitMaster)
                                                <option value="{{ $UnitMaster->id }}" selected>
                                                    {{ $UnitMaster->nm_unit }}
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
                                    <label class="col-sm-4 text-md-right">Uraian Dokumen <span>*</span></label>
                                    <div class="col-sm-6">
                                        <input name="nm_spmi_m" type="text"
                                            class="form-control form-control-sm @error('nm_spmi_m') is-invalid @enderror"
                                            value="{{ old('nm_spmi_m') }}" placeholder="Input SPMI" required>
                                        @error('nm_spmi_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Kode Dokumen</label>
                                    <div class="col-sm-6">
                                        <input name="no_spmi_m" type="text"
                                            class="form-control form-control-sm @error('no_spmi_m') is-invalid @enderror"
                                            value="{{ old('no_spmi_m') }}" placeholder="Nomor SPMI">
                                        @error('no_spmi_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-sm-4 text-md-right">Status Dokumen SPMI</label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input name="status_spmi_m" id="status_spmi_m" value="1"
                                                class="form-check-input @error('status_spmi_m') is-invalid @enderror"
                                                type="checkbox">
                                            <label class="form-check-label">Aktif</label>
                                            @error('status_spmi_m')
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
            var x = document.getElementById("status_spmi_m");
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('spmi') }}" + '/' + data.id;
                //console.log(update);
                $('#update select[name=mutu_sistem_id_m]').val(data.mutu_sistem_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=versi_master_id_m]').val(data.versi_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=unit_master_m]').val(data.unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update input[name=nm_spmi_m]').val(data.nm_spmi);
                $('#update input[name=no_spmi_m]').val(data.no_spmi);
                if (data.status_spmi == 1) {
                    x.checked = true;
                } else {
                    x.checked = false;
                }
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
