@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Mahasiswa & Almumni')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-dark card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#dosen"
                            role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Dosen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#tendik"
                            role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Tendik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#mitra"
                            role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Stakeholder</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="dosen" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">
                        <div class="form-group-sm">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info" data-toggle="modal" data-target="#add">
                                <i class="fa fa-file-edit"></i> Add New</a>
                            <a href="" class="btn btn-sm btn-warning">
                                <i class="fa fa-file-export"></i> Eksport Data</a>
                            <a href="" class="btn btn-sm btn-success">
                                <i class="fa fa-download"></i> Template File</a>
                        </div>
                        <p></p>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama Dosen</th>
                                        <th class="text-center">Gender</th>
                                        <th>Program Studi</th>
                                        <th>E-Mail</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($MahasiswaMasters as $MahasiswaMaster)
                                        <tr id="hide{{ $MahasiswaMaster->id }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $MahasiswaMaster->nomor }}</td>
                                            <td>{{ $MahasiswaMaster->nama }}</td>
                                            <td>{{ $MahasiswaMaster->gender }}</td>
                                            <td>{{ $MahasiswaMaster->unit_master->nm_unit }}</td>
                                            <td class="text-center">{{ $MahasiswaMaster->angkatan_id }}</td>
                                            <td>
                                                <div class="text-center">
                                                    @can('admin')
                                                        <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                            onclick="edit(this)"
                                                            data-route="{{ route('induk_master_dokumen.edit', $MahasiswaMaster->id) }}"
                                                            data-toggle="modal" data-target="#update">
                                                            <i class="fa fa-edit fa-fw"></i>
                                                        </a>
                                                    @endcan
                                                    <a href="{{ route('induk_detail_dokumen.show', Crypt::encrypt($MahasiswaMaster->id)) }}"
                                                        class="btn-sm btn-outline-danger" data-toggle="tooltip"
                                                        title="View/Post"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="tendik" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <div class="form-group-sm">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info" data-toggle="modal" data-target="#add">
                                <i class="fa fa-file-edit"></i> Add New</a>
                            <a href="" class="btn btn-sm btn-warning">
                                <i class="fa fa-file-export"></i> Eksport Data</a>
                            <a href="" class="btn btn-sm btn-success">
                                <i class="fa fa-download"></i> Template File</a>
                        </div>
                        <p></p>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama Tendik</th>
                                        <th class="text-center">Gender</th>
                                        <th>Unit Kerja</th>
                                        <th>E-Mail</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($MahasiswaMasters as $MahasiswaMaster)
                                        <tr id="hide{{ $MahasiswaMaster->id }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $MahasiswaMaster->nomor }}</td>
                                            <td>{{ $MahasiswaMaster->nama }}</td>
                                            <td>{{ $MahasiswaMaster->gender }}</td>
                                            <td>{{ $MahasiswaMaster->unit_master->nm_unit }}</td>
                                            <td class="text-center">{{ $MahasiswaMaster->angkatan_id }}</td>
                                            <td>
                                                <div class="text-center">
                                                    @can('admin')
                                                        <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                            onclick="edit(this)"
                                                            data-route="{{ route('induk_master_dokumen.edit', $MahasiswaMaster->id) }}"
                                                            data-toggle="modal" data-target="#update">
                                                            <i class="fa fa-edit fa-fw"></i>
                                                        </a>
                                                    @endcan
                                                    <a href="{{ route('induk_detail_dokumen.show', Crypt::encrypt($MahasiswaMaster->id)) }}"
                                                        class="btn-sm btn-outline-danger" data-toggle="tooltip"
                                                        title="View/Post"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="mitra" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <div class="form-group-sm">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info" data-toggle="modal" data-target="#add">
                                <i class="fa fa-file-edit"></i> Add New</a>
                            <a href="" class="btn btn-sm btn-warning">
                                <i class="fa fa-file-export"></i> Eksport Data</a>
                            <a href="" class="btn btn-sm btn-success">
                                <i class="fa fa-download"></i> Template File</a>
                        </div>
                        <p></p>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nomor MoU</th>
                                        <th>Nama Stakeholder</th>
                                        <th>Unit Kerjasama</th>
                                        <th class="text-center">Instansi</th>
                                        <th>E-Mail</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($MahasiswaMasters as $MahasiswaMaster)
                                        <tr id="hide{{ $MahasiswaMaster->id }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $MahasiswaMaster->nomor }}</td>
                                            <td>{{ $MahasiswaMaster->nama }}</td>
                                            <td>{{ $MahasiswaMaster->gender }}</td>
                                            <td>{{ $MahasiswaMaster->unit_master->nm_unit }}</td>
                                            <td class="text-center">{{ $MahasiswaMaster->angkatan_id }}</td>
                                            <td>
                                                <div class="text-center">
                                                    @can('admin')
                                                        <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                            onclick="edit(this)"
                                                            data-route="{{ route('induk_master_dokumen.edit', $MahasiswaMaster->id) }}"
                                                            data-toggle="modal" data-target="#update">
                                                            <i class="fa fa-edit fa-fw"></i>
                                                        </a>
                                                    @endcan
                                                    <a href="{{ route('induk_detail_dokumen.show', Crypt::encrypt($MahasiswaMaster->id)) }}"
                                                        class="btn-sm btn-outline-danger" data-toggle="tooltip"
                                                        title="View/Post"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>

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
            $('#datatable').DataTable();
        });
        $(document).ready(function() {
            $('#datatable1').DataTable();
        });
        $(document).ready(function() {
            $('#datatable2').DataTable();
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
                console.log(data);
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
