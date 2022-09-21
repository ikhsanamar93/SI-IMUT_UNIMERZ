@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Data User')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data User Account</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i> Add User
                        </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">User</th>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Unit Kerja</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr id="hide{{ $user->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if ($user->user_kategori == 1)
                                            <span class="badge bg-fuchsia">Dosen</span>
                                        @else
                                            <span class="badge bg-purple">Tendik</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->nomor }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->unit_master->nm_unit }}</td>
                                    <td class="text-center">
                                        @if ($user->role == 1)
                                            <span class="badge bg-info">Super Admin</span>
                                        @elseif ($user->role == 2)
                                            <span class="badge bg-warning">Admin</span>
                                        @elseif ($user->role == 3)
                                            <span class="badge bg-primary">User</span>
                                        @elseif ($user->role == 4)
                                            <span class="badge bg-maroon">User Admin</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($user->is_aktif == 1)
                                            <span class="badge bg-success">True</span>
                                        @else
                                            <span class="badge bg-dark">False</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)" data-route="{{ route('data_user.edit', $user->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="add">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('data_user.store') }}" method="post" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row mb-1 mb-0">
                                    <label class="col-sm-3 col-form-label">Jenis User *</label>
                                    <div class="col-sm-9 mb-0">
                                        <div>
                                            <input value="1" type="radio" name="user_kategori" required>
                                            <span class="mr-2">Dosen </span>
                                            <input value="2" type="radio" name="user_kategori" required>
                                            <span class="mr-2">Tendik</span>
                                        </div>
                                        @error('user_kategori')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Nama User *</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama"
                                            class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                            placeholder="Nama User" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Nomor Identitas *</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nomor"
                                            class="form-control form-control-sm @error('nomor') is-invalid @enderror"
                                            placeholder="Nomor Identitas" value="{{ old('nomor') }}" maxlength="30"
                                            required>
                                        @error('nomor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Gender *</label>
                                    <div class="col-sm-9 mb-0">
                                        <div>
                                            <input value="L" type="radio" name="gender" required>
                                            <span class="mr-2">Laki-Laki </span>
                                            <input value="P" type="radio" name="gender" required>
                                            <span class="mr-2">Perempuan</span>
                                        </div>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Unit Kerja *</label>
                                    <div class="col-sm-9">
                                        <select name="unit_master_id"
                                            class="form-control form-control-sm select2 @error('unit_master_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($UnitMasters as $UnitMaster)
                                                @if (old('unit_master_id') == $UnitMaster->id)
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
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Homebase Fakultas <span>*</span></label>
                                    <div class="col-sm-9">
                                        <select name="fakultas_id"
                                            class="form-control form-control-sm select2 @error('fakultas_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;">
                                            <option></option>
                                            @foreach ($Fakultast as $Fakultas)
                                                @if (old('fakultas_id') == $Fakultas->id)
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
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Homebase Prodi <span>*</span></label>
                                    <div class="col-sm-9">
                                        <select name="prodi_id"
                                            class="form-control form-control-sm select2 @error('prodi_id') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;">
                                            <option></option>
                                            @foreach ($Prodis as $Prodi)
                                                @if (old('prodi_id') == $Prodi->id)
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
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Telp/HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="hp"
                                            class="form-control form-control-sm @error('hp') is-invalid @enderror"
                                            placeholder="Telp/HP" value="{{ old('hp') }}" maxlength="12">
                                        @error('hp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">E-Mail *</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            placeholder="E-Mail" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control form-control-sm" name="alamat" cols="30" rows="3">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">User Role *</label>
                                    <div class="col-sm-9 mb-0">
                                        <div>
                                            <input value="1" type="radio" name="role" required>
                                            <span class="mr-2">Super Admin</span>
                                            <input value="2" type="radio" name="role" required>
                                            <span class="mr-2">Admin</span>
                                            <input value="3" type="radio" name="role" required>
                                            <span class="mr-2">User</span>
                                            <input value="4" type="radio" name="role" required>
                                            <span class="mr-2">User Admin</span>
                                        </div>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Password *</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password"
                                            class="form-control form-control-sm @error('password') is-invalid @enderror"
                                            value="12345678" placeholder="Password" required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Konfirm Password *</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="konfirmasi_password"
                                            class="form-control form-control-sm @error('konfirmasi_password') is-invalid @enderror"
                                            value="12345678" placeholder="Konfirmasi Password" required>
                                        @error('konfirmasi_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Status Akun</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input name="is_aktif" id="is_aktif" value="1"
                                                class="form-check-input @error('is_aktif') is-invalid @enderror"
                                                type="checkbox">
                                            <label class="form-check-label">Aktif</label>
                                            @error('is_aktif')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-check-circle"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="fa fa-cancel"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="update">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" autocomplete="off">
                            @method('PUT') @csrf
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group row mb-1 mb-0">
                                    <label class="col-sm-3 col-form-label">Jenis User *</label>
                                    <div class="col-sm-9 mb-0">
                                        <div>
                                            <input value="1" type="radio" name="user_kategori_m"
                                                id="user_kategori_m1" required>
                                            <span class="mr-2">Dosen </span>
                                            <input value="2" type="radio" name="user_kategori_m"
                                                id="user_kategori_m2" required>
                                            <span class="mr-2">Tendik</span>
                                        </div>
                                        @error('user_kategori_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Nama User *</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_m"
                                            class="form-control form-control-sm @error('nama_m') is-invalid @enderror"
                                            placeholder="Nama User" value="{{ old('nama_m') }}" required>
                                        @error('nama_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Nomor Identitas *</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nomor_m"
                                            class="form-control form-control-sm @error('nomor_m') is-invalid @enderror"
                                            placeholder="Nomor Identitas" value="{{ old('nomor_m') }}" maxlength="30"
                                            required>
                                        @error('nomor_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Gender *</label>
                                    <div class="col-sm-9 mb-0">
                                        <div>
                                            <input value="L" type="radio" name="gender_m" id="gender_m1"
                                                required>
                                            <span class="mr-2">Laki-Laki </span>
                                            <input value="P" type="radio" name="gender_m" id="gender_m2"
                                                required>
                                            <span class="mr-2">Perempuan</span>
                                        </div>
                                        @error('gender_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Unit Kerja *</label>
                                    <div class="col-sm-9">
                                        <select name="unit_master_id_m"
                                            class="form-control form-control-sm select2 @error('unit_master_id_m') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;" required>
                                            <option></option>
                                            @foreach ($UnitMasters as $UnitMaster)
                                                @if (old('unit_master_id_m') == $UnitMaster->id)
                                                    <option value="{{ $UnitMaster->id }}" selected>
                                                        {{ $UnitMaster->nm_unit }}</option>
                                                @else
                                                    <option value="{{ $UnitMaster->id }}">
                                                        {{ $UnitMaster->nm_unit }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('unit_master_id_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Homebase Fakultas <span>*</span></label>
                                    <div class="col-sm-9">
                                        <select name="fakultas_id_m"
                                            class="form-control form-control-sm select2 @error('fakultas_id_m') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;">
                                            <option></option>
                                            @foreach ($Fakultast as $Fakultas)
                                                @if (old('fakultas_id_m') == $Fakultas->id)
                                                    <option value="{{ $Fakultas->id }}" selected>
                                                        {{ $Fakultas->nm_unit }}</option>
                                                @else
                                                    <option value="{{ $Fakultas->id }}">
                                                        {{ $Fakultas->nm_unit }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('fakultas_id_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Homebase Prodi <span>*</span></label>
                                    <div class="col-sm-9">
                                        <select name="prodi_id_m"
                                            class="form-control form-control-sm select2 @error('prodi_id_m') is-invalid @enderror"
                                            data-dropdown-css-class="select2-dark" style="width: 100%;">
                                            <option></option>
                                            @foreach ($Prodis as $Prodi)
                                                @if (old('prodi_id_m') == $Prodi->id)
                                                    <option value="{{ $Prodi->id }}" selected>
                                                        {{ $Prodi->nm_unit }}</option>
                                                @else
                                                    <option value="{{ $Prodi->id }}">
                                                        {{ $Prodi->nm_unit }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('prodi_id_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Telp/HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="hp_m"
                                            class="form-control form-control-sm @error('hp_m') is-invalid @enderror"
                                            placeholder="Telp/HP" value="{{ old('hp_m') }}" maxlength="12">
                                        @error('hp_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">E-Mail *</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email_m"
                                            class="form-control form-control-sm @error('email_m') is-invalid @enderror"
                                            placeholder="E-Mail" value="{{ old('email_m') }}" required>
                                        @error('email_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control form-control-sm" name="alamat_m" cols="30" rows="3">{{ old('alamat_m') }}</textarea>
                                        @error('alamat_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">User Role *</label>
                                    <div class="col-sm-9 mb-0">
                                        <div>
                                            <input value="1" type="radio" name="role_m" id="role1" required>
                                            <span class="mr-2">Super Admin</span>
                                            <input value="2" type="radio" name="role_m" id="role2" required>
                                            <span class="mr-2">Admin</span>
                                            <input value="3" type="radio" name="role_m" id="role3" required>
                                            <span class="mr-2">User</span>
                                            <input value="4" type="radio" name="role_m" id="role4" required>
                                            <span class="mr-2">User Admin</span>
                                        </div>
                                        @error('role_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Password *</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_m"
                                            class="form-control form-control-sm @error('password_m') is-invalid @enderror"
                                            value="12345678" placeholder="Password" required>
                                        @error('password_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Konfirm Password *</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="konfirmasi_password_m"
                                            class="form-control form-control-sm @error('konfirmasi_password_m') is-invalid @enderror"
                                            value="12345678" placeholder="Konfirmasi Password" required>
                                        @error('konfirmasi_password_m')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label class="col-sm-3 col-form-label">Status Akun</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input name="is_aktif_m" id="is_aktif_m" value="1"
                                                class="form-check-input @error('is_aktif_m') is-invalid @enderror"
                                                type="checkbox">
                                            <label class="form-check-label">Aktif</label>
                                            @error('is_aktif_m')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" required readonly>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-check-circle"></i> Update
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                    <i class="fa fa-cancel"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        $('select').select2();

        $(document).ready(function() {
            $('#dataTable').DataTable();
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

        function edit(el) {
            var x = document.getElementById("is_aktif_m");
            var r1 = document.getElementById("role1")
            var r2 = document.getElementById("role2")
            var r3 = document.getElementById("role3")
            var r4 = document.getElementById("role4")
            var uk1 = document.getElementById("user_kategori_m1")
            var uk2 = document.getElementById("user_kategori_m2")
            var g1 = document.getElementById("gender_m1")
            var g2 = document.getElementById("gender_m2")
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('data_user') }}" + '/' + data[0].id;
                // console.log(update);
                $('#update input[name=nama_m]').val(data[0].nama);
                $('#update input[name=nomor_m]').val(data[0].nomor);
                $('#update select[name=unit_master_id_m]').val(data[0].unit_master_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=fakultas_id_m]').val(data[1].fakultas_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update select[name=prodi_id_m]').val(data[1].prodi_id).attr("selected", "selected")
                    .select2().trigger('change');
                $('#update input[name=email_m]').val(data[0].email);
                $('#update input[name=hp_m]').val(data[1].hp);
                $('#update textarea[name=alamat_m]').val(data[1].alamat);
                $('#update input[name=user_id]').val(data[1].id);
                if (data[0].user_kategori == 1) {
                    uk1.checked = true;
                } else {
                    uk2.checked = true;
                }
                if (data[1].gender == 'L') {
                    g1.checked = true;
                } else {
                    g2.checked = true;
                }
                if (data[0].role == 1) {
                    r1.checked = true;
                } else if (data[0].role == 2) {
                    r2.checked = true;
                } else if (data[0].role == 3) {
                    r3.checked = true;
                } else if (data[0].role == 4) {
                    r4.checked = true;
                }
                if (data[0].is_aktif == 1) {
                    x.checked = true;
                } else {
                    x.checked = false;
                }
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
