@extends('layouts.main')
@section('title', 'SI-IMUT | Dashboard')
@section('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/fullcalendar.css') }}">
@endsection
@section('heading')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Sistem Informasi Penjaminan Mutu</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">SI-IMUT</a></li>
                <li class="breadcrumb-item active">v1-Pro</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $MutuKategoris }}</h3>

                        <p>Instrumen SPMI</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $SpmiStandarMasters }}</h3>

                        <p>Standar SPMI</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $MonevMasters }}</h3>

                        <p>Instrumen Monev</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $Users }}</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body p-0">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agenda">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agenda SPMI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Agenda *</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control-sm form-control" style="background-color: white"
                                name="title" id="title" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Unit Kerja *</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control-sm form-control" style="background-color: white"
                                name="unit_master_id" id="unit_master_id" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Auditee *</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control-sm form-control" style="background-color: white"
                                name="auditee_id" id="auditee_id" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Auditor 1 *</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control-sm form-control" style="background-color: white"
                                name="auditor_1" id="auditor_1" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 text-md-right">Auditor 2 *</span></label>
                        <div class="col-md-7">
                            <input type="text" class="form-control-sm form-control" style="background-color: white"
                                name="auditor_2" id="auditor_2" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function() {
            var jadwal = @json($events);
            $('#calendar').fullCalendar({
                selectable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay'
                },
                events: jadwal,
                eventClick: function(event) {
                    $('#title').val(event.title);
                    $('#unit_master_id').val(event.unit_master_id);
                    $('#auditee_id').val(event.auditee_id);
                    $('#auditor_1').val(event.auditor_1);
                    $('#auditor_2').val(event.auditor_2);
                    $('#start').val(event.start);
                    $('#agenda').modal({

                    })
                }
            });
        });
    </script>
@endsection
