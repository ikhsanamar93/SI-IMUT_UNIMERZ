@extends('layouts.main')
@section('title', 'SI-IMUT | Profile Account')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('image/app/user.png') }}"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $Profile->nama }}</h3>
                <p class="text-muted text-center">{{ $Profile->unit_master->nm_unit }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>E-Mail</b> <a class="float-right">{{ $Profile->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>User Account</b> <a class="float-right">{{ $Profile->nomor }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Password</b> <a class="float-right">**********</a>
                    </li>
                </ul>


            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data User Akun</h3>
            </div>
            <form action="{{ route('ubah_profile', $Profile->id) }}" method="post">
                @csrf @method('PUT')
                <div class="card-body">
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Nama {{ $data }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama"
                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                placeholder="Nama {{ $data }}" value="{{ $Profile->nama }}" required="">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Nomor Identitas</label>
                        <div class="col-sm-9">
                            <input type="text" name="nomor"
                                class="form-control form-control-sm @error('nomor') is-invalid @enderror"
                                placeholder="Nomor Identitas" value="{{ $Profile->nomor }}" maxlength="30">
                            @error('nomor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                            @if ($Profile->gender === 'L')
                                <div>
                                    <input value="L" type="radio" name="gender" checked required>
                                    <label>Laki-Laki </label>
                                    <input value="P" type="radio" name="gender" required>
                                    <label>Perempuan</label>
                                </div>
                            @else
                                <div>
                                    <input value="L" type="radio" name="gender" required>
                                    <label>Laki-Laki </label>
                                    <input value="P" type="radio" name="gender" checked required>
                                    <label>Perempuan</label>
                                </div>
                            @endif
                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Unit Kerja</label>
                        <div class="col-sm-9">
                            <select name="unit_master_id"
                                class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                <option></option>
                                @foreach ($UnitMasters as $UnitMaster)
                                    @if ($Profile->unit_master_id == $UnitMaster->id)
                                        <option value="{{ $UnitMaster->id }}" selected>
                                            {{ $UnitMaster->nm_unit }}</option>
                                    @else
                                        <option value="{{ $UnitMaster->id }}">
                                            {{ $UnitMaster->nm_unit }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('unit_master_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Homebase Fakultas <span>*</span></label>
                        <div class="col-sm-9">
                            <select name="fakultas_id"
                                class="form-control form-control-sm select2 @error('fakultas_id') is-invalid @enderror"
                                data-dropdown-css-class="select2-dark" style="width: 100%;">
                                <option></option>
                                @foreach ($Fakultast as $Fakultas)
                                    @if ($Profile->fakultas_id == $Fakultas->id)
                                        <option value="{{ $Fakultas->id }}" selected>
                                            {{ $Fakultas->nm_unit }}</option>
                                    @else
                                        <option value="{{ $Fakultas->id }}">
                                            {{ $Fakultas->nm_unit }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('fakultas_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Homebase Prodi <span>*</span></label>
                        <div class="col-sm-9">
                            <select name="prodi_id"
                                class="form-control form-control-sm select2 @error('prodi_id') is-invalid @enderror"
                                data-dropdown-css-class="select2-dark" style="width: 100%;">
                                <option></option>
                                @foreach ($Prodis as $Prodi)
                                    @if ($Profile->prodi_id == $Prodi->id)
                                        <option value="{{ $Prodi->id }}" selected>
                                            {{ $Prodi->nm_unit }}</option>
                                    @else
                                        <option value="{{ $Prodi->id }}">
                                            {{ $Prodi->nm_unit }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Telp/HP</label>
                        <div class="col-sm-9">
                            <input type="text" name="hp"
                                class="form-control form-control-sm @error('hp') is-invalid @enderror"
                                placeholder="Telp/HP" value="{{ $Profile->hp }}" maxlength="12">
                            @error('hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">E-Mail</label>
                        <div class="col-sm-9">
                            <input type="email" name="email"
                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                placeholder="E-Mail" value="{{ $Profile->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control form-control-sm" name="alamat" cols="30" rows="3">{{ $Profile->alamat }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                placeholder="Password" required>
                            <small><i>Password minimum 8 digit</i></small>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 col-form-label">Konfirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="konfirmasi_password"
                                class="form-control form-control-sm @error('konfirmasi_password') is-invalid @enderror"
                                placeholder="Konfirmasi Password" required>
                            @error('konfirmasi_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="profil_id" value="{{ $Profile->id }}" readonly>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}" readonly>
                    <input type="hidden" name="auth_id" value="{{ auth()->user()->id }}" readonly>
                    <input type="hidden" name="role" value="{{ auth()->user()->role }}" readonly>
                    <input type="hidden" name="user_kategori" value="{{ auth()->user()->user_kategori }}" readonly>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-sm btn-dark btn-center">
                        <i class="far fa-circle-check"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $('select').select2();

        $(function() {
            $('#tgl_penetapan').datetimepicker({
                format: 'YYYY/MM/DD'
            });
        })
    </script>
@endsection
