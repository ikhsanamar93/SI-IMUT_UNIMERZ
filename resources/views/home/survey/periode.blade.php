@extends('home.home_layout')
@section('title', 'SI-IMUT | List Survey')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('body')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><small>Sistem Informasi Penjaminan Mutu</small></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">IJAGO SPMI</a></li>
                            <li class="breadcrumb-item active">v1-Pro</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card card-dark card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Survey Program Studi</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Tahun Akademik</th>
                                                <th class="text-center">Semester</th>
                                                <th>Surveyor</th>
                                                <th>Survey Kategori</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($SurveyPeriodes as $SurveyPeriode)
                                                <tr id="hide{{ $SurveyPeriode->id }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">
                                                        {{ $SurveyPeriode->mutu_periode->siklus }}
                                                    </td>
                                                    <td class="text-center">{{ $SurveyPeriode->semester }}</td>
                                                    <td>{{ $SurveyPeriode->unit_master->nm_unit }}</td>
                                                    <td>{{ $SurveyPeriode->kuesioner_master->monev_master->nm_monev }}
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            @if (App\Models\ResponMaster::where('survey_periode_id', $SurveyPeriode->id)->where('responden_kategori', $target)->where('responden_id', $data->id)->first() != null)
                                                                <span class="btn btn-sm btn-info text-lg-center"><i
                                                                        class="far fa-check-circle"></i> Done</span>
                                                            @else
                                                                <form
                                                                    action="{{ route('create_respon', Crypt::encrypt($SurveyPeriode->kuesioner_master_id)) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm"
                                                                        name="survey_periode_id"
                                                                        value="{{ $SurveyPeriode->id }}" readonly>
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm" name="id"
                                                                        value="{{ $data->id }}" readonly>
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm" name="target"
                                                                        value="{{ $target }}" readonly>
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-success border-0"> <i
                                                                            class="fa fa-edit fa-fw"></i> Survey</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-dark card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Survey Fakultas</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap" id="dataTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Tahun Akademik</th>
                                                <th class="text-center">Semester</th>
                                                <th>Surveyor</th>
                                                <th>Survey Kategori</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($SurveyPeriodesF as $SurveyPeriode)
                                                <tr id="hide{{ $SurveyPeriode->id }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $SurveyPeriode->mutu_periode->siklus }}
                                                    </td>
                                                    <td class="text-center">{{ $SurveyPeriode->semester }}</td>
                                                    <td>{{ $SurveyPeriode->unit_master->nm_unit }}</td>
                                                    <td>{{ $SurveyPeriode->kuesioner_master->monev_master->nm_monev }}
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            @if (App\Models\ResponMaster::where('survey_periode_id', $SurveyPeriode->id, 'and')->where('responden_kategori', $target, 'and')->where('responden_id', $data->id, 'and')->first() != null)
                                                                <span class="btn btn-sm btn-info text-lg-center"><i
                                                                        class="far fa-check-circle"></i> Done</span>
                                                            @else
                                                                <form
                                                                    action="{{ route('create_respon', Crypt::encrypt($SurveyPeriode->kuesioner_master_id)) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm"
                                                                        name="survey_periode_id"
                                                                        value="{{ $SurveyPeriode->id }}" readonly>
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm" name="id"
                                                                        value="{{ $data->id }}" readonly>
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm" name="target"
                                                                        value="{{ $target }}" readonly>
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-success border-0"> <i
                                                                            class="fa fa-edit fa-fw"></i> Survey</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-dark card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Survey Institusi</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Tahun Akademik</th>
                                                <th class="text-center">Semester</th>
                                                <th>Surveyor</th>
                                                <th>Survey Kategori</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($SurveyPeriodesI as $SurveyPeriode)
                                                <tr id="hide{{ $SurveyPeriode->id }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">
                                                        {{ $SurveyPeriode->mutu_periode->siklus }}
                                                    </td>
                                                    <td class="text-center">{{ $SurveyPeriode->semester }}</td>
                                                    <td>{{ $SurveyPeriode->unit_master->nm_unit }}</td>
                                                    <td>{{ $SurveyPeriode->kuesioner_master->monev_master->nm_monev }}
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            @if (App\Models\ResponMaster::where('survey_periode_id', $SurveyPeriode->id, 'and')->where('responden_kategori', $target, 'and')->where('responden_id', $data->id, 'and')->first() != null)
                                                                <span class="btn btn-sm btn-info text-lg-center"><i
                                                                        class="far fa-check-circle"></i> Done</span>
                                                            @else
                                                                <form
                                                                    action="{{ route('create_respon', Crypt::encrypt($SurveyPeriode->kuesioner_master_id)) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm"
                                                                        name="survey_periode_id"
                                                                        value="{{ $SurveyPeriode->id }}" readonly>
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm"
                                                                        name="id" value="{{ $data->id }}"
                                                                        readonly>
                                                                    <input type="hidden"
                                                                        class="form-control form-control-sm"
                                                                        name="target" value="{{ $target }}"
                                                                        readonly>
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-success border-0"> <i
                                                                            class="fa fa-edit fa-fw"></i> Survey</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
@endsection
