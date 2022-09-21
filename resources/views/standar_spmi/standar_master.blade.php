@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Standar SPMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header ">
                <h3 class="card-title"> Standar SPMI </h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        @can('admin')
                            <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                                <i class="fa fa-plus"></i> Add Standar</a>
                        @endcan
                        <a href="{{ route('standar_master.index') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Kategori Standar</th>
                                <th>Nama Standar</th>
                                <th>Kode Standar</th>
                                <th class="text-center">Status</th>
                                @can('admin')
                                    <th></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SpmiStandarMasters as $SpmiStandarMaster)
                                <tr id="hide{{ $SpmiStandarMaster->id }}" data-widget="expandable-table"
                                    aria-expanded="true">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $SpmiStandarMaster->mutu_kategori->nm_kategori_mutu }}</td>
                                    <td>{{ $SpmiStandarMaster->nm_standar_spmi }}</td>
                                    <td>{{ $SpmiStandarMaster->no_standar_spmi }}</td>
                                    <td class="text-center">
                                        @if ($SpmiStandarMaster->status_spmi == 1)
                                            <span class="badge bg-danger">True</span>
                                        @else
                                            <span class="badge bg-dark">False</span>
                                        @endif
                                    </td>
                                    @can('admin')
                                        <td>
                                            <div class="text-center">
                                                <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                    onclick="edit(this)"
                                                    data-route="{{ route('standar_master.edit', $SpmiStandarMaster->id) }}"
                                                    data-toggle="modal" data-target="#update">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                </a>
                                                <a href="{{ route('standar_detail.show', Crypt::encrypt($SpmiStandarMaster->id)) }}"
                                                    class="btn-sm btn-outline-primary" data-toggle="tooltip"
                                                    title="View/Post"><i class="fa fa-table-columns"></i></a>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                                <tr class="expandable-body">
                                    <td colspan="7">
                                        <div class="mt-0 mb-0">
                                            <table class="table-responsive table-sm" width="100%" cellspacing="0">
                                                <tbody>
                                                    <tr class="mb-0">
                                                        @foreach ($SpmiStandarMaster->spmi_standar_detail as $SpmiStandarMaster)
                                                            <td class="mb-0">
                                                                <a class="badge btn-sm btn-info"
                                                                    href="{{ route('standar_detail.edit', Crypt::encrypt($SpmiStandarMaster->id)) }}">{{ $SpmiStandarMaster->poin }}</a><span
                                                                    class="badge">isi Standar</span>
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
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
                            <h5 class="modal-title">Add Standar SPMI</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('standar_master.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Kategori SPMI <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="mutu_kategori_id"
                                            class="form-control form-control-sm select2 @error('mutu_kategori_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($MutuKategoris as $MutuKategori)
                                                @if (old('mutu_kategori_id') == $MutuKategori->id)
                                                    <option value="{{ $MutuKategori->id }}" selected>
                                                        {{ $MutuKategori->nm_kategori_mutu }}</option>
                                                @else
                                                    <option value="{{ $MutuKategori->id }}">
                                                        {{ $MutuKategori->nm_kategori_mutu }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('mutu_kategori_id')
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
                                            <option value="{{ $UnitMaster->id }}" selected>
                                                {{ $UnitMaster->nm_unit }}</option>
                                        </select>
                                        @error('unit_master_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Nama Standar <span>*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="nm_standar_spmi"
                                            class="form-control form-control-sm @error('nm_standar_spmi') is-invalid @enderror"
                                            value="{{ old('nm_standar_spmi') }}" placeholder="Nama Standar SPMI"
                                            required>
                                        @error('nm_standar_spmi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Kode Standar <span>*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="no_standar_spmi"
                                            class="form-control form-control-sm @error('no_standar_spmi') is-invalid @enderror"
                                            value="{{ old('no_standar_spmi') }}" placeholder="Kode Standar SPMI"
                                            maxlength="30" required>
                                        @error('no_standar_spmi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Status Standar </label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input name="status_spmi" id="status_spmi" value="1"
                                                class="form-check-input @error('status_spmi') is-invalid @enderror"
                                                value="{{ old('status_spmi') }}" type="checkbox">
                                            <label class="form-check-label">Aktiv</label>
                                        </div>
                                        @error('status_spmi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                            <h5 class="modal-title">Edit Standar SPMI</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf @method('PUT')
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Kategori SPMI <span>*</span></label>
                                    <div class="col-sm-6">
                                        <select name="mutu_kategori_id_m"
                                            class="form-control form-control-sm select2 @error('mutu_kategori_id_m') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($MutuKategoris as $MutuKategori)
                                                <option value="{{ $MutuKategori->id }}">
                                                    {{ $MutuKategori->nm_kategori_mutu }}</option>
                                            @endforeach
                                        </select>
                                        @error('mutu_kategori_id_m')
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
                                            <option value="{{ $UnitMaster->id }}" selected>{{ $UnitMaster->nm_unit }}
                                            </option>
                                        </select>
                                        @error('unit_master_id_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Nama Standar <span>*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="nm_standar_spmi_m"
                                            class="form-control form-control-sm @error('nm_standar_spmi_m') is-invalid @enderror"
                                            value="{{ old('nm_standar_spmi_m') }}" placeholder="Nama Standar SPMI"
                                            required>
                                        @error('nm_standar_spmi_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Kode Standar <span>*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="no_standar_spmi_m"
                                            class="form-control form-control-sm @error('no_standar_spmi_m') is-invalid @enderror"
                                            value="{{ old('no_standar_spmi_m') }}" placeholder="Kode Standar SPMI"
                                            maxlength="20" required>
                                        @error('no_standar_spmi_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 text-md-right">Status Standar </label>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input name="status_spmi_m" id="status_spmi_m" value="1"
                                                class="form-check-input @error('status_spmi_m') is-invalid @enderror"
                                                value="{{ old('status_spmi_m') }}" type="checkbox">
                                            <label class="form-check-label">Aktiv</label>
                                        </div>
                                        @error('status_spmi_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
            var x = document.getElementById("status_spmi_m");
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('standar_master') }}" + '/' + data.id;
                // console.log(update);
                $('#update select[name=mutu_kategori_id_m]').val(data.mutu_kategori_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=versi_master_id_m]').val(data.versi_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=unit_master_id_m]').val(data.unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update input[name=nm_standar_spmi_m]').val(data.nm_standar_spmi);
                $('#update input[name=no_standar_spmi_m]').val(data.no_standar_spmi);
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
