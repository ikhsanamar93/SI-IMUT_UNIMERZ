@extends('layouts.main')
@section('title', 'SI-IMUT | Kriteria Akreditasi')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
    <div class="col-md-4">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Input Kategori Akreditasi</h3>
            </div>
            <form action="{{ route('akreditasi_kategori.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                        Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori <span>*</span></label>
                        <input type="text" class="form-control form-control-sm" name="nm_kategori"
                            placeholder="Input Kategori" required>
                    </div>
                    <div class="form-group">
                        <label>Kode Kategori</label>
                        <input type="text" class="form-control form-control-sm" name="no_kategori"
                            placeholder="Kode Kategori" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control form-control-sm" rows="4" name="ket" placeholder="Deskripsi Kategori ..."></textarea>
                    </div>
                </div>
                @can('super_admin')
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-dark">
                            <i class="far fa-check-circle"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-sm btn-danger float-right">
                            <i class="fa fa-cancel"></i> Cancel
                        </button>
                    </div>
                @endcan
            </form>
            <div class="modal fade" id="update">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kategori Akreditasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" autocomplete="off">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group">
                                    <label>Nama Kategori <span>*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="nm_kategori"
                                        placeholder="Input Kategori" required>
                                </div>
                                <div class="form-group">
                                    <label>Kode Kategori</label>
                                    <input type="text" class="form-control form-control-sm" name="no_kategori"
                                        placeholder="Kode Kategori" maxlength="30">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control form-control-sm" rows="4" name="ket" placeholder="Deskripsi Kategori ..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-check-circle"></i> Update
                                </button>
                                <button type="button" class="btn btn-sm  btn-danger" data-dismiss="modal">
                                    <i class="fa fa-cancel"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Data Kategori Akreditasi</h3>
            </div>
            <div class="card-body">
                <div class="card-body table-responsive p-0" style="height: 460px;">
                    <table class="table table-head-fixed">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Kategori</th>
                                <th>Kode</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach ($AkreditasiKategoris as $AkreditasiKategori)
                            <tbody>
                                <tr id="hide{{ $AkreditasiKategori->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $AkreditasiKategori->nm_kategori }}</td>
                                    <td>{{ $AkreditasiKategori->no_kategori }}</td>
                                    <td>
                                        @can('super_admin')
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success" onclick="edit(this)"
                                                data-route="{{ route('akreditasi_kategori.edit', $AkreditasiKategori->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                        @endcan
                                        <a href="{{ route('akreditasi_kategori.show', Crypt::encrypt($AkreditasiKategori->id)) }}"
                                            class="btn-sm btn-outline-primary">
                                            <i class="fa fa-table-columns"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script>
        function edit(el) {
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('akreditasi_kategori') }}" + '/' + data.id;
                // console.log(update);
                $('.modal input[name=nm_kategori]').val(data.nm_kategori);
                $('.modal input[name=no_kategori]').val(data.no_kategori);
                $('.modal textarea[name=ket]').val(data.ket);
                $('.modal form').attr('action', update);
            });
        }
    </script>
@endsection
