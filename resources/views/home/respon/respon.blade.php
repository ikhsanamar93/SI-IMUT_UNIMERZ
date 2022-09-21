@extends('home.home_layout')
@section('title', 'SI-IMUT | Responden Survey')
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
                                <h5 class="card-title m-0">Data Responden</h5>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-right">
                                        <form action="{{ route('index_respon') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="responden_kategori"
                                                class="form-control form-control-sm @error('responden_kategori') is-invalid @enderror"
                                                value="{{ $kategori }}" readonly required>
                                            <input type="hidden" name="nomor"
                                                class="form-control form-control-sm @error('nomor') is-invalid @enderror"
                                                value="{{ Crypt::encrypt($data->nomor) }}" readonly required>
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i
                                                    class="fa fa-arrow-left"></i> Kembali</button>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-danger">
                                    {{-- <h5><i class="fas fa-warning "></i><b> Note:</b></h5> --}}
                                    <span class="text-sm text-bold">Kepada Responden Yang Terhormat.</span>
                                    <p>
                                        <span class="text-sm">Saat ini {{ $SurveyPeriode->unit_master->nm_unit }}
                                            sedang melakukan survey untuk menjamin <b>Pelaksanaan Penjaminan Mutu</b>.
                                            Partisipasi anda <b>sangat kami harapkan</b> dalam mengisi kuesioner ini. Semua
                                            keterangan dan jawaban yang diperoleh
                                            semata-mata hanya untuk kepentingan {{ $SurveyPeriode->unit_master->nm_unit }}
                                            dan dijamin <b>kerahasiaannya</b>. Setiap jawaban yang diberikan merupakan
                                            <b>bantuan yang tidak ternilai besarnya</b> bagi
                                            {{ $SurveyPeriode->unit_master->nm_unit }} . Terima Kasih atas bantuan dan
                                            kesediaan bapak/ibu untuk meluangkan waktu dalam mengisi kuesioner ini.</span>
                                    </p>
                                </div>
                                <form action="{{ route('save_respon') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="survey_periode_id"
                                            class="form-control form-control-sm @error('survey_periode_id') is-invalid @enderror"
                                            value="{{ $SurveyPeriode->id }}" readonly required>
                                        <input type="hidden" name="mutu_periode_id"
                                            class="form-control form-control-sm @error('mutu_periode_id') is-invalid @enderror"
                                            value="{{ $SurveyPeriode->mutu_periode_id }}" readonly required>
                                        <input type="hidden" name="unit_master_id"
                                            class="form-control form-control-sm @error('unit_master_id') is-invalid @enderror"
                                            value="{{ $SurveyPeriode->unit_master_id }}" readonly required>
                                        <input type="hidden" name="kuesioner_master_id"
                                            class="form-control form-control-sm @error('kuesioner_master_id') is-invalid @enderror"
                                            value="{{ $SurveyPeriode->kuesioner_master_id }}" readonly required>
                                        <input type="hidden" name="responden_id"
                                            class="form-control form-control-sm @error('responden_id') is-invalid @enderror"
                                            value="{{ $data->id }}" readonly required>
                                        <input type="hidden" name="responden_kategori"
                                            class="form-control form-control-sm @error('responden_kategori') is-invalid @enderror"
                                            value="{{ $kategori }}" readonly required>
                                        <input type="hidden" name="responden_target"
                                            class="form-control form-control-sm @error('responden_target') is-invalid @enderror"
                                            value="{{ $target }}" readonly required>
                                        <input type="hidden" name="nomor"
                                            class="form-control form-control-sm @error('nomor') is-invalid @enderror"
                                            value="{{ Crypt::encrypt($data->nomor) }}" readonly required>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Nomor Identitas</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nomor_identitas"
                                                class="form-control form-control-sm @error('nomor_identitas') is-invalid @enderror"
                                                value="{{ $data->nomor }}" placeholder="Nomor Identitas" maxlength="20"
                                                readonly required>
                                            @error('nomor_identitas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 text-md-right">Nama Responden</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="nama"
                                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                                value="{{ $data->nama }}" placeholder="Nama Responden" readonly required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label class="col-sm-4 text-md-right">Prodi/Institusi</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="unit_master_name"
                                                class="form-control form-control-sm @error('unit_master_name') is-invalid @enderror"
                                                value="{{ $data->unit_master->nm_unit }}" placeholder="Unit Kerja"
                                                readonly required>
                                            <span class="text-xs"><i> isilah kuesioner sesuai dengan kondisi yang
                                                    sebenarnya, data dan isian anda akan kami RAHASIAKAN!!!</i></span>
                                            @error('unit_master_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-dark card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Detail Kuesioner</h5>
                            </div>
                            <div class="card-body">
                                <ol>
                                    @foreach ($KuesionerDetails as $KuesionerDetail)
                                        <li class="mb-0">
                                            {!! $KuesionerDetail->pertanyaan !!}
                                            <input type="hidden" class="form-control form-control-sm"
                                                name="kuesioner_detail_id[]" value="{{ $KuesionerDetail->id }}"
                                                readonly>
                                            <ul>
                                                <li>
                                                    <div>
                                                        <input value="1" type="radio"
                                                            name="jawaban[{{ $KuesionerDetail->id }}]" required>
                                                        <label>{{ $KuesionerDetail->jawaban_1 }}</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <input value="2" type="radio"
                                                            name="jawaban[{{ $KuesionerDetail->id }}]" required>
                                                        <label>{{ $KuesionerDetail->jawaban_2 }}</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <input value="3" type="radio"
                                                            name="jawaban[{{ $KuesionerDetail->id }}]" required>
                                                        <label>{{ $KuesionerDetail->jawaban_3 }}</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <input value="4" type="radio"
                                                            name="jawaban[{{ $KuesionerDetail->id }}]" required>
                                                        <label>{{ $KuesionerDetail->jawaban_4 }}</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <input value="5" type="radio"
                                                            name="jawaban[{{ $KuesionerDetail->id }}]" required>
                                                        <label>{{ $KuesionerDetail->jawaban_5 }}</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card card-dark card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Kotak Saran</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <label for="">Berikan Saran Anda</label>
                                    <textarea name="responden_ket" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-sm btn-dark btn-center">
                                    <i class="far fa-circle-check"></i> Simpan Jawaban
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
