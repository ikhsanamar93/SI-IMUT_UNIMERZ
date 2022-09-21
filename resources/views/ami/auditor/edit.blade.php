@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
@endsection
@section('title', 'SI-IMUT | Edit AMI SPMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Formulir Edit AMI SPMI</h3>
                <div class="card-tools">
                    <a href="{{ route('show_ami_detail', Crypt::encrypt($AmiPeriodeDetails->ami_periode_id)) }}"
                        class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
            </div>
            <form method="POST" action="{{ route('update_ami_detail', $AmiPeriodeDetails->id) }}" autocomplete="off">
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
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $AmiPeriodeDetails->ami_periode_id }}" name="ami_periode_id"
                                class="form-control form-control-sm text-bold" readonly required>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $AmiPeriodeDetails->ami_periode_master_id }}"
                                name="ami_periode_master_id" class="form-control form-control-sm text-bold" readonly
                                required>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $AmiPeriodeDetails->spmi_standar_master_id }}"
                                name="spmi_standar_master_id" class="form-control form-control-sm text-bold" readonly
                                required>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $AmiPeriodeDetails->spmi_standar_detail_id }}"
                                name="spmi_standar_detail_id" class="form-control form-control-sm text-bold" readonly
                                required>
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
                        <textarea name="daftar_tilik" class="form-control form-control-sm @error('daftar_tilik') is-invalid @enderror"
                            id="daftar_tilik">{!! $AmiPeriodeDetails->daftar_tilik !!}</textarea>
                        @error('daftar_tilik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Observasi *</label>
                        <textarea name="observasi" class="form-control form-control-sm @error('observasi') is-invalid @enderror" id="observasi">{!! $AmiPeriodeDetails->observasi !!}</textarea>
                        @error('observasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Temuan AMI *</label>
                        <select name="temuan" class="form-control select2 " data-dropdown-css-class="select2-dark"
                            style="width: 100%;" required>
                            @if ($AmiPeriodeDetails->temuan == 'S')
                                <option></option>
                                <option value="S" selected>Sesuai</option>
                                <option value="OB">Observasi</option>
                                <option value="KTsM">KTs Mayor</option>
                                <option value="KTsMi">KTs Minor</option>
                            @elseif ($AmiPeriodeDetails->temuan == 'OB')
                                <option></option>
                                <option value="S">Sesuai</option>
                                <option value="OB" selected>Observasi</option>
                                <option value="KTsM">KTs Mayor</option>
                                <option value="KTsMi">KTs Minor</option>
                            @elseif ($AmiPeriodeDetails->temuan == 'KTsM')
                                <option></option>
                                <option value="S">Sesuai</option>
                                <option value="OB">Observasi</option>
                                <option value="KTsM" selected>KTs Mayor</option>
                                <option value="KTsMi">KTs Minor</option>
                            @elseif ($AmiPeriodeDetails->temuan == 'KTsMi')
                                <option></option>
                                <option value="S">Sesuai</option>
                                <option value="OB">Observasi</option>
                                <option value="KTsM">KTs Mayor</option>
                                <option value="KTsMi" selected>KTs Minor</option>
                            @else
                                <option></option>
                                <option value="S">Sesuai</option>
                                <option value="OB">Observasi</option>
                                <option value="KTsM">KTs Mayor</option>
                                <option value="KTsMi">KTs Minor</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Deskripsi Temuan AMI *</label>
                        <textarea name="uraian_temuan" class="form-control form-control-sm @error('uraian_temuan') is-invalid @enderror"
                            id="uraian_temuan">{!! $AmiPeriodeDetails->uraian_temuan !!}</textarea>
                        @error('uraian_temuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Akar Masalah *</label>
                        <textarea name="akar_masalah" class="form-control form-control-sm @error('akar_masalah') is-invalid @enderror"
                            id="akar_masalah">{!! $AmiPeriodeDetails->akar_masalah !!}</textarea>
                        @error('akar_masalah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Peluang Peningkatan *</label>
                        <textarea name="peluang_peningkatan"
                            class="form-control form-control-sm @error('peluang_peningkatan') is-invalid @enderror" id="peluang_peningkatan">{!! $AmiPeriodeDetails->peluang_peningkatan !!}</textarea>
                        @error('peluang_peningkatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Rekomendasi *</label>
                        <textarea name="rekomendasi" class="form-control form-control-sm @error('rekomendasi') is-invalid @enderror"
                            id="rekomendasi">{!! $AmiPeriodeDetails->rekomendasi !!}</textarea>
                        @error('rekomendasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-sm btn-dark">
                        <i class="far fa-check-circle"></i> Update
                    </button>
            </form>
            <form action="{{ route('delete_ami_detail', $AmiPeriodeDetails->id) }}" method="post" class="d-inline">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data.?')"> <i
                        class="far fa-trash-alt"></i> Delete</button>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $('select').select2();

        ClassicEditor
            .create(document.querySelector('#daftar_tilik'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#observasi'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#uraian_temuan'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#akar_masalah'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#peluang_peningkatan'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#rekomendasi'))
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
