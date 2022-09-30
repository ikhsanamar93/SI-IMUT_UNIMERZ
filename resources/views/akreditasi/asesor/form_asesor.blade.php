@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
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
                <h3 class="card-title">Formulir Audit Akreditasi</h3>
                <div class="card-tools">
                    <a href="{{ route('show_akreditasi_asesor', Crypt::encrypt($AkreditasiPeriodeDetails->akreditasi_periode_id)) }}"
                        class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
            </div>
            <form method="POST" action="{{ route('save_akreditasi_asesor', $AkreditasiPeriodeDetails->id) }}"
                autocomplete="off">
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
                                name="akreditasi_periode_id" class="form-control form-control-sm text-bold" readonly
                                required>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $AkreditasiPeriodeDetails->akreditasi_kategori_id }}"
                                name="akreditasi_kategori_id" class="form-control form-control-sm text-bold" readonly
                                required>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $AkreditasiPeriodeDetails->akreditasi_master_id }}"
                                name="akreditasi_master_id" class="form-control form-control-sm text-bold" readonly
                                required>
                        </div>
                    </div>
                    <div class="form-group mb-0 mt-0">
                        <label class="col-form-label-lg mb-0">Deskripsi Kriteria</label>
                        <br><Span>{!! $AkreditasiPeriodeDetails->akreditasi_master->indikator !!}</Span>
                    </div>
                    <div class="form-group mb-0 mt-0">
                        <label class="col-form-label-lg mb-0">Indikator Penilaian</label>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sesuai = Poin 4</th>
                                        <th class="text-center">Observasi = Poin 3</th>
                                        <th class="text-center">KTS-Mi = Poin 2</th>
                                        <th class="text-center">KTS-Ma = Poin 1</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{!! $AkreditasiPeriodeDetails->akreditasi_master->indikator_4 !!}</td>
                                        <td>{!! $AkreditasiPeriodeDetails->akreditasi_master->indikator_3 !!}</td>
                                        <td>{!! $AkreditasiPeriodeDetails->akreditasi_master->indikator_2 !!}</td>
                                        <td>{!! $AkreditasiPeriodeDetails->akreditasi_master->indikator_1 !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group mb-0 mt-0">
                        <label class="col-form-label-lg mb-0">Dokumen Terkait</label>
                        <br><Span>{!! $AkreditasiPeriodeDetails->akreditasi_master->dokumen_terkait !!}</Span>
                    </div>
                    <div class="form-group mb-0 mt-0">
                        <label class="col-form-label-lg">Daftar Tilik *</label>
                        <textarea name="daftar_tilik" class="form-control form-control-sm @error('daftar_tilik') is-invalid @enderror"
                            id="daftar_tilik">{{ old('daftar_tilik', $AkreditasiPeriodeDetails->daftar_tilik) }}</textarea>
                        @error('daftar_tilik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <label class="col-form-label-lg">Uraian Temuan * </label> <label class="col-form-label-sm">
                            (PLOR)</label>
                        <textarea name="observasi" class="form-control form-control-sm @error('observasi') is-invalid @enderror" id="observasi">{{ old('observasi', $AkreditasiPeriodeDetails->observasi) }}</textarea>
                        @error('observasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Analisis Penyebab * </label> <label class="col-form-label-sm">
                            (Akar Masalah)</label>
                        <textarea name="uraian_temuan" class="form-control form-control-sm @error('uraian_temuan') is-invalid @enderror"
                            id="uraian_temuan">{{ old('uraian_temuan', $AkreditasiPeriodeDetails->uraian_temuan) }}</textarea>
                        @error('uraian_temuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small><i>Analisis Penyebab Boleh Kosong jika Temuan <b>Sesuai</b></i></small>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Temuan Asesor *</label>
                        <select name="temuan" class="form-control select2 " data-dropdown-css-class="select2-dark"
                            style="width: 100%;">
                            @if (old('temuan', $AkreditasiPeriodeDetails->temuan) == 'S')
                                <option></option>
                                <option value="S" selected>Sesuai/Poin 4</option>
                                <option value="OB">Observasi/Poin 3</option>
                                <option value="KTsM">KTs Mayor/Poin 1</option>
                                <option value="KTsMi">KTs Minor/Poin 2</option>
                            @elseif (old('temuan', $AkreditasiPeriodeDetails->temuan) == 'OB')
                                <option></option>
                                <option value="S">Sesuai</option>
                                <option value="OB" selected>Observasi</option>
                                <option value="KTsM">KTs Mayor</option>
                                <option value="KTsMi">KTs Minor</option>
                            @elseif (old('temuan', $AkreditasiPeriodeDetails->temuan) == 'KTsM')
                                <option></option>
                                <option value="S">Sesuai</option>
                                <option value="OB">Observasi</option>
                                <option value="KTsM" selected>KTs Mayor</option>
                                <option value="KTsMi">KTs Minor</option>
                            @elseif (old('temuan', $AkreditasiPeriodeDetails->temuan) == 'KTsMi')
                                <option></option>
                                <option value="S">Sesuai</option>
                                <option value="OB">Observasi</option>
                                <option value="KTsM">KTs Mayor</option>
                                <option value="KTsMi" selected>KTs Minor</option>
                            @else
                                <option></option>
                                <option value="S">Sesuai/Poin 4</option>
                                <option value="OB">Observasi/Poin 3</option>
                                <option value="KTsM">KTs Mayor/Poin 2</option>
                                <option value="KTsMi">KTs Minor/Poin 1</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Penilaian Asesor *</label>
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nilai Asesor</th>
                                        <th>Bobot Kriteria</th>
                                        <th>Hasil Penilaian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="input-group input-group">
                                                <input type="text" name="skor" id="skor"
                                                    class="form-control @error('skor') is-invalid @enderror"
                                                    onkeypress="return hanyaAngka(event)"
                                                    value="{{ old('skor', $AkreditasiPeriodeDetails->skor) }}"
                                                    placeholder="Penilaian Asesor" maxlength="20">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info btn-flat"
                                                        onClick="hitung()"><i class="fa fa-code"></i></button>
                                                </span>
                                            </div>
                                            @error('skor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="bobot_penilaian" id="bobot_penilaian"
                                                class="form-control @error('bobot_penilaian') is-invalid @enderror"
                                                value="{{ $AkreditasiPeriodeDetails->akreditasi_master->bobot_penilaian }}"
                                                maxlength="20" style="background-color: white" readonly>
                                            @error('bobot_penilaian')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="perolehan_skor" id="perolehan_skor"
                                                class="form-control @error('perolehan_skor') is-invalid @enderror"
                                                value="{{ old('perolehan_skor', $AkreditasiPeriodeDetails->perolehan_skor) }}"
                                                placeholder="Perolehan Nilai" maxlength="20"
                                                style="background-color: white" readonly required>
                                            @error('perolehan_skor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Rekomendasi *</label>
                        <textarea name="rekomendasi" class="form-control form-control-sm @error('rekomendasi') is-invalid @enderror"
                            id="rekomendasi">{{ old('rekomendasi', $AkreditasiPeriodeDetails->rekomendasi) }}</textarea>
                        @error('rekomendasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Praktik Baik </label> <label class="col-form-label-sm"> (Jika
                            Ada) </label>
                        <textarea name="praktek_baik" class="form-control form-control-sm @error('praktek_baik') is-invalid @enderror"
                            id="praktek_baik">{{ old('praktek_baik', $AkreditasiPeriodeDetails->praktek_baik) }}</textarea>
                        @error('praktek_baik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Efektifitas RTK </label> <label class="col-form-label-sm"> (Audit
                            Periode Sebelumnya) </label>
                        <textarea name="efektifitas_rtk" class="form-control form-control-sm @error('efektifitas_rtk') is-invalid @enderror"
                            id="efektifitas_rtk">{{ old('efektifitas_rtk', $AkreditasiPeriodeDetails->efektifitas_rtk) }}</textarea>
                        @error('efektifitas_rtk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-sm btn-dark">
                        <i class="far fa-check-circle"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-sm btn-danger">
                        <i class="fa fa-cancel"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $('select').select2();

        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        function hitung() {
            var x = document.getElementById("skor").value;
            var y = document.getElementById("bobot_penilaian").value;
            var z = x * y;
            document.getElementById("perolehan_skor").value = z.toFixed(2);
        }

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
            .create(document.querySelector('#rekomendasi'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#praktek_baik'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#efektifitas_rtk'))
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
