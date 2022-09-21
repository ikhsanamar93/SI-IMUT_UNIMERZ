@extends('home.home_layout')
@section('title', 'SI-IMUT | Pernyataan SPMI')
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

                    <div class="col-md-12">
                        <div class="card card-outline card-gray-dark">
                            <div class="card-header">
                                <h3 class="card-title">Pernyataan Standar SPMI</h3>
                                <div class="card-tools">
                                    <a href="{{ route('standar_spmi') }}" class="btn-sm btn-outline-danger"><i
                                            class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mt-0 mb-0">
                                    <label class="col-form-label-lg">Detail Informasi</label>
                                    <div class="table-responsive">
                                        <table class="table text-nowrap" id="dataTable" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">Unit Kerja</th>
                                                    <th style="width: 2%">:</th>
                                                    <th>{{ $SpmiStandarMasters->unit_master->nm_unit }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 10%">Standar SPMI</th>
                                                    <th style="width: 2%">:</th>
                                                    <th>{{ $SpmiStandarMasters->no_standar_spmi }}.
                                                        {{ $SpmiStandarMasters->nm_standar_spmi }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 10%">Poin</th>
                                                    <th style="width: 2%">:</th>
                                                    <th>{{ $SpmiStandardetails->poin }}.
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="col-form-label-lg mb-0">Pernyataan Standar</label>
                                    <br><Span>{!! $SpmiStandardetails->pernyataan !!}</Span>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="col-form-label-lg mb-0">Strategi Pencapaian</label>
                                    <br><Span>{!! $SpmiStandardetails->strategi !!}</Span>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="col-form-label-lg mb-0">Indikator Kinerja</label>
                                    <br><Span>{!! $SpmiStandardetails->indikator !!}</Span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
