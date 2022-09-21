@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Data Alumni')
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
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#mahasiswa"
                            role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#alumni"
                            role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Alumni</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="rekapitulasi" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">



                    </div>

                    <div class="tab-pane fade show active" id="rekapitulasi" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">



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
