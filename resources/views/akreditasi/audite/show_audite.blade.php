@extends('layouts.main')
@section('css')

@endsection
@section('title', 'SI-IMUT | Form AMI SPMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Hasil Audit Akreditasi</h3>
                <div class="card-tools">
                    <a href="{{ route('show_akreditasi_audite', Crypt::encrypt($AkreditasiPeriodeDetails->akreditasi_periode_id)) }}"
                        class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    <label class="col-form-label-lg">Detail Informasi</label>
                    <div class="table-responsive">
                        <table class="table text-nowrap" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Unit Kerja</th>
                                    <th style="width: 2%">:</th>
                                    <th>{{ $AkreditasiPeriodeDetails->akreditasi_periode->unit_master->nm_unit }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Siklus</th>
                                    <th style="width: 2%">:</th>
                                    <th>{{ $AkreditasiPeriodeDetails->akreditasi_periode->mutu_periode->siklus }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Instrumen Akreditasi</th>
                                    <th style="width: 2%">:</th>
                                    <th>{{ $AkreditasiPeriodeDetails->akreditasi_master->no_akreditasi_master }}.
                                        {{ $AkreditasiPeriodeDetails->akreditasi_master->monev_kategori->nm_jenis_monev }}
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Temuan</th>
                                    <th style="width: 2%">:</th>
                                    <th>
                                        @if ($AkreditasiPeriodeDetails->temuan == 'S')
                                            <span class="badge btn-info">{{ $AkreditasiPeriodeDetails->temuan }}</span>
                                        @elseif ($AkreditasiPeriodeDetails->temuan == 'OB')
                                            <span
                                                class="badge badge-warning">{{ $AkreditasiPeriodeDetails->temuan }}</span>
                                        @elseif ($AkreditasiPeriodeDetails->temuan == 'KTsM')
                                            <span
                                                class="badge badge-danger">{{ $AkreditasiPeriodeDetails->temuan }}</span>
                                        @elseif ($AkreditasiPeriodeDetails->temuan == 'KTsMi')
                                            <span
                                                class="badge badge-danger">{{ $AkreditasiPeriodeDetails->temuan }}</span>
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 10%">Penilaian Asesor</th>
                                    <th style="width: 2%">:</th>
                                    <th>
                                        Nilai: <span class="badge btn-warning">
                                            {{ $AkreditasiPeriodeDetails->skor }}</span>
                                        Perolehan: <span class="badge badge-info">
                                            {{ $AkreditasiPeriodeDetails->perolehan_skor }}</span>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="form-group row mt-0 mb-0">
                    <div class="col-sm-2">
                        <input type="hidden" value="{{ $AkreditasiPeriodeDetails->id }}" name="id"
                            class="form-control form-control-sm text-bold" readonly required>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" value="{{ $AkreditasiPeriodeDetails->akreditasi_periode_id }}"
                            name="akreditasi_periode_id" class="form-control form-control-sm text-bold" readonly required>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" value="{{ $AkreditasiPeriodeDetails->akreditasi_kategori_id }}"
                            name="akreditasi_kategori_id" class="form-control form-control-sm text-bold" readonly required>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" value="{{ $AkreditasiPeriodeDetails->akreditasi_master_id }}"
                            name="akreditasi_master_id" class="form-control form-control-sm text-bold" readonly required>
                    </div>
                </div>
                <div class="form-group mb-0 mt-0">
                    <label class="col-form-label-lg mb-0">Deskripsi Kriteria</label>
                    <br><Span>{!! $AkreditasiPeriodeDetails->akreditasi_master->indikator !!}</Span>
                </div>
                <div class="form-group mb-0 mt-0">
                    <label class="col-form-label-lg mb-0">Indikator Kinerja</label>
                    <br><span>{!! $AkreditasiPeriodeDetails->akreditasi_master->indikator_kinerja !!}</span>
                </div>
                <div class="form-group mb-0 mt-0">
                    <label class="col-form-label-lg mb-0">Dokumen Terkait</label>
                    <br><Span>{!! $AkreditasiPeriodeDetails->akreditasi_master->dokumen_terkait !!}</Span>
                </div>
                <div class="form-group mb-0 mt-0">
                    <label class="col-form-label-lg">Daftar Tilik *</label>
                    <br><Span>{!! $AkreditasiPeriodeDetails->daftar_tilik !!}</Span>
                </div>
                <div class="form-group mb-0">
                    <label class="col-form-label-lg">Observasi Asesor *</label>
                    <br><Span>{!! $AkreditasiPeriodeDetails->observasi !!}</Span>
                </div>
                <div class="form-group">
                    <label class="col-form-label-lg">Uraian Temuan *</label>
                    <br><Span>{!! $AkreditasiPeriodeDetails->uraian_temuan !!}</Span>
                </div>
                <div class="form-group">
                    <label class="col-form-label-lg">Rekomendasi *</label>
                    <br><Span>{!! $AkreditasiPeriodeDetails->rekomendasi !!}</Span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
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
