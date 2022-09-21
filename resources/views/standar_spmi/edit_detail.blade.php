@extends('layouts.main')
@section('css')
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
                <h3 class="card-title">Edit Standar SPMI</h3>
                <div class="card-tools">
                    <a href="{{ route('standar_master.show', Crypt::encrypt($SpmiStandarMasters->unit_master_id)) }}"
                        class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
            </div>
            <form action="{{ route('standar_detail.update', $SpmiStandardetails->id) }}" method="POST"
                autocomplete="off">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Poin *</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                </div>
                                <input type="number" name="poin"
                                    class="form-control form-control-sm text-bold @error('poin') is-invalid @enderror"
                                    value="{{ $SpmiStandardetails->poin }}" placeholder="Poin Standar">
                                @error('poin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Kode</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-code-fork"></i></span>
                                </div>
                                <input type="text" value="{{ $SpmiStandarMasters->no_standar_spmi }}"
                                    name="no_standar_spmi" class="form-control form-control-sm text-bold" disabled required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Nama Standar</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope-open-text"></i></span>
                                </div>
                                <input type="text" value="{{ $SpmiStandarMasters->nm_standar_spmi }}"
                                    name="nm_standar_spmi" class="form-control form-control-sm text-bold" disabled required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Unit Kerja</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-institution"></i></span>
                                </div>
                                <input type="text" value="{{ $SpmiStandarMasters->unit_master->nm_unit }}"
                                    name="unit_kerja" class="form-control form-control-sm text-bold" disabled required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $SpmiStandarMasters->id }}" name="spmi_standar_master_id"
                                class="form-control form-control-sm" readonly required>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $SpmiStandarMasters->unit_master_id }}" name="unit_master_id"
                                class="form-control form-control-sm" readonly required>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="{{ $SpmiStandardetails->id }}" name="id"
                                class="form-control form-control-sm" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Pernyataan Standar *</label>
                        <textarea name="pernyataan" class="form-control form-control-sm @error('pernyataan') is-invalid @enderror"
                            id="pernyataan">{!! $SpmiStandardetails->pernyataan !!}</textarea>
                        @error('pernyataan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Strategi Pencapaian *</label>
                        <textarea name="strategi" class="form-control form-control-sm @error('strategi') is-invalid @enderror" id="strategi">{!! $SpmiStandardetails->strategi !!}</textarea>
                        @error('strategi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label-lg">Indikator Kinerja *</label>
                        <textarea name="indikator" class="form-control form-control-sm @error('indikator') is-invalid @enderror" id="indikator">{!! $SpmiStandardetails->indikator !!}</textarea>
                        @error('indikator')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-center">
                    @can('admin')
                        <button type="submit" class="btn btn-sm btn-dark">
                            <i class="far fa-check-circle"></i> Update
                        </button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('#pernyataan'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#strategi'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#indikator'))
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
