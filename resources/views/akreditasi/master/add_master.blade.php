@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Pernyataan Standar SPMI')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Formulir Instrumen Akreditasi</h3>
                <div class="card-tools">
                    <a href="{{ route('akreditasi_kategori.show', Crypt::encrypt($AkreditasiKategoris->id)) }}"
                        class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
            </div>
            <form action="{{ route('save_akreditasi_master') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Instrumen Kategori</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                </div>
                                <input type="text" value="{{ $AkreditasiKategoris->nm_kategori }}" name="nm_kategori"
                                    class="form-control form-control-sm text-bold" disabled required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label>Kriteria Akreditasi *</label>
                            <div class="input-group mb-3">
                                <select name="monev_kategori_id"
                                    class="form-control form-control-sm select2 @error('monev_kategori_id') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    @foreach ($MonevKategoris as $MonevKategori)
                                        @if (old('monev_kategori_id') == $MonevKategori->id)
                                            <option value="{{ $MonevKategori->id }}" selected>
                                                {{ $MonevKategori->nm_jenis_monev }}</option>
                                        @else
                                            <option value="{{ $MonevKategori->id }}">
                                                {{ $MonevKategori->nm_jenis_monev }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('monev_kategori_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Dokumen *</label>
                            <div class="input-group mb-2">
                                <select name="jenis_dokumen"
                                    class="form-control form-control-sm select2 @error('jenis_dokumen') is-invalid @enderror"
                                    data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                    <option></option>
                                    <option value="LED">LED</option>
                                    <option value="LKPT/PS">LKPT/PS</option>
                                </select>
                                @error('jenis_dokumen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Butir *</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                                <input type="text" name="no_akreditasi_master"
                                    class="form-control form-control-sm text-bold @error('no_akreditasi_master') is-invalid @enderror"
                                    value="{{ old('no_akreditasi_master') }}" placeholder="Butir" required>
                                @error('no_akreditasi_master')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Bobot *</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calculator"></i></span>
                                </div>
                                <input type="text" name="bobot_penilaian" onkeypress="return hanyaAngka(event)"
                                    class="form-control form-control-sm text-bold @error('bobot_penilaian') is-invalid @enderror"
                                    value="{{ old('bobot_penilaian') }}" placeholder="Bobot" required>
                                @error('bobot_penilaian')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $AkreditasiKategoris->id }}" name="akreditasi_kategori_id"
                                class="form-control form-control-sm" readonly required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Sub Elemen</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-code-fork"></i></span>
                                </div>
                                <input type="text" name="elemen"
                                    class="form-control form-control-sm @error('elemen') is-invalid @enderror"
                                    value="{{ old('elemen') }}" placeholder="Butir">
                                @error('elemen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Deskripsi *</label>
                        <textarea name="indikator" class="form-control form-control-sm @error('indikator') is-invalid @enderror" id="indikator">{{ old('indikator') }}</textarea>
                        @error('indikator')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Indikator Kinerja *</label>
                        <textarea name="indikator_kinerja" class="form-control form-control-sm @error('indikator_kinerja') is-invalid @enderror"
                            id="indikator_kinerja">{{ old('indikator_kinerja') }}</textarea>
                        @error('indikator_kinerja')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Dokumen Terkait</label>
                        <textarea name="dokumen_terkait" class="form-control form-control-sm @error('dokumen_terkait') is-invalid @enderror"
                            id="dokumen_terkait">{{ old('dokumen_terkait') }}</textarea>
                        @error('dokumen_terkait')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $('select').select2();

        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        ClassicEditor
            .create(document.querySelector('#indikator'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#indikator_kinerja'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#dokumen_terkait'))
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
