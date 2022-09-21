@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
@endsection
@section('title', 'SI-IMUT | Show AMI SPMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Hasil AMI SPMI</h3>
                <div class="card-tools">
                    <a href="{{ route('ami_master.show', Crypt::encrypt($AmiPeriodeDetails->ami_periode_id)) }}"
                        class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
            </div>
            <form method="POST" action="{{ route('ami_master.update', $AmiPeriodeDetails->id) }}" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Detail Informasi</label>
                        <div class="table-responsive">
                            <table class="table text-nowrap" id="dataTable" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">Unit Kerja</th>
                                        <th style="width: 2%">:</th>
                                        <th>{{ $AmiPeriodeDetails->spmi_standar_master->unit_master->nm_unit }}</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 10%">Standar SPMI</th>
                                        <th style="width: 2%">:</th>
                                        <th>{{ $AmiPeriodeDetails->spmi_standar_master->no_standar_spmi }}.
                                            {{ $AmiPeriodeDetails->spmi_standar_master->nm_standar_spmi }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 10%">Poin</th>
                                        <th style="width: 2%">:</th>
                                        <th>{{ $AmiPeriodeDetails->spmi_standar_detail->poin }}.</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 10%">Temuan</th>
                                        <th style="width: 2%">:</th>
                                        <th>
                                            @if ($AmiPeriodeDetails->temuan == 'S')
                                                <span class="badge badge-info">{{ $AmiPeriodeDetails->temuan }}</span>
                                            @elseif ($AmiPeriodeDetails->temuan == 'OB')
                                                <span class="badge badge-warning">{{ $AmiPeriodeDetails->temuan }}</span>
                                            @elseif ($AmiPeriodeDetails->temuan == 'KTsM')
                                                <span class="badge badge-danger">{{ $AmiPeriodeDetails->temuan }}</span>
                                            @elseif ($AmiPeriodeDetails->temuan == 'KTsMi')
                                                <span class="badge badge-danger">{{ $AmiPeriodeDetails->temuan }}</span>
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $AmiPeriodeDetails->ami_periode_id }}" name="ami_periode_id"
                                class="form-control form-control-sm text-bold" readonly required>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg mb-0">Pernyataan Standar</label>
                        <br><Span>{!! $AmiPeriodeDetails->spmi_standar_detail->pernyataan !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg mb-0">Strategi Pencapaian</label>
                        <br><Span>{!! $AmiPeriodeDetails->spmi_standar_detail->strategi !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg mb-0">Indikator Kinerja</label>
                        <br><Span>{!! $AmiPeriodeDetails->spmi_standar_detail->indikator !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Daftar Tilik *</label>
                        <br><Span>{!! $AmiPeriodeDetails->daftar_tilik !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Observasi *</label>
                        <br><Span>{!! $AmiPeriodeDetails->observasi !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Deskripsi Temuan AMI *</label>
                        <br><Span>{!! $AmiPeriodeDetails->uraian_temuan !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Akar Masalah *</label>
                        <br><Span>{!! $AmiPeriodeDetails->akar_masalah !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Peluang Peningkatan *</label>
                        <br><Span>{!! $AmiPeriodeDetails->peluang_peningkatan !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Rekomendasi *</label>
                        <br><Span>{!! $AmiPeriodeDetails->rekomendasi !!}</Span>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Permintaan Tindakan Koreksi *</label>
                        <textarea name="rtk" class="form-control form-control-sm @error('rtk') is-invalid @enderror" id="rtk">{{ old('rtk', $AmiPeriodeDetails->rtk) }}</textarea>
                        @error('rtk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-sm btn-dark">
                        <i class="far fa-check-circle"></i> Submit RTK
                    </button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('#rtk'))
            .catch(error => {
                console.error(error);
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
    </script>
@endsection
