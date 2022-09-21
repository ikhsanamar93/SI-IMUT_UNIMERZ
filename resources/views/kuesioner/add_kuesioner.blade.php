@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Master Monev Mutu')
@section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="toast toastsDefaultWarning"></div>
        @endif
    </div>
    <div class="col-md-12">

        <div class="modal fade" id="add">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kuesioner {{ $KuesionerMasters->unit_master->nm_unit }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('kuesioner_detail.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <div class="callout callout-danger">
                                <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                            </div>
                            <div class="form-group mb-1">
                                <label>Jenis Monev</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-code-fork"></i></span>
                                    </div>
                                    <input type="text" value="{{ $KuesionerMasters->monev_master->nm_monev }}"
                                        name="no_standar_spmi" class="form-control form-control-sm text-bold" disabled
                                        required>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label>Pertanyaan <span>*</span></label>
                                <textarea name="pertanyaan" class="form-control form-control-sm @error('pertanyaan') is-invalid @enderror"
                                    id="pertanyaan">{{ old('pertanyaan') }}</textarea>
                                @error('pertanyaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label>Jawaban A <span>*</span></label>
                                <input type="text" name="jawaban_1"
                                    class="form-control form-control-sm @error('jawaban_1') is-invalid @enderror"
                                    placeholder="Input Jawaban" value="Sangat Baik" required>
                                @error('jawaban_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label>Jawaban B <span>*</span></label>
                                <input type="text" name="jawaban_2"
                                    class="form-control form-control-sm @error('jawaban_2') is-invalid @enderror"
                                    placeholder="Input Jawaban" value="Baik" required>
                                @error('jawaban_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label>Jawaban C <span>*</span></label>
                                <input type="text" name="jawaban_3"
                                    class="form-control form-control-sm @error('jawaban_3') is-invalid @enderror"
                                    placeholder="Input Jawaban" value="Cukup Baik" required>
                                @error('jawaban_3')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label>Jawaban D <span>*</span></label>
                                <input type="text" name="jawaban_4"
                                    class="form-control form-control-sm @error('jawaban_4') is-invalid @enderror"
                                    placeholder="Input Jawaban" value="Kurang Baik" required>
                                @error('jawaban_4')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label>Jawaban E <span>*</span></label>
                                <input type="text" name="jawaban_5"
                                    class="form-control form-control-sm @error('jawaban_5') is-invalid @enderror"
                                    placeholder="Input Jawaban" value="Buruk">
                                @error('jawaban_5')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" name="kuesioner_master_id" value="{{ $KuesionerMasters->id }}"
                                class="form-control form-control-sm @error('kuesioner_master_id') is-invalid @enderror"
                                required readonly>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-sm btn-dark">
                                <i class="far fa-circle-check"></i> Submit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                <i class="fa fa-cancel"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Kuesioner Detail</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="javascript:void(0)" class="btn-sm btn-outline-dark" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i> Add Kuesioner
                        </a>
                        <a href="{{ route('kuesioner.show', Crypt::encrypt($KuesionerMasters->unit_master->id)) }}"
                            class="btn-sm btn-outline-danger"><i class="fa fa-arrow-left"></i> Kembali </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Pertanyaan</th>
                                <th class="text-center">Jawaban</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($KuesionerDetails as $KuesionerDetail)
                                <tr id="hide{{ $KuesionerDetail->id }}">
                                    <td class="text-center text-nowrap">{{ $loop->iteration }}</td>
                                    <td>{!! $KuesionerDetail->pertanyaan !!}</td>
                                    <td style="min-width: 4cm">
                                        <ol>
                                            <li>{{ $KuesionerDetail->jawaban_1 }}</li>
                                            <li>{{ $KuesionerDetail->jawaban_2 }}</li>
                                            <li>{{ $KuesionerDetail->jawaban_3 }}</li>
                                            <li>{{ $KuesionerDetail->jawaban_4 }}</li>
                                            <li>{{ $KuesionerDetail->jawaban_5 }}</li>
                                        </ol>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn-sm btn-outline-success"
                                                onclick="edit(this)"
                                                data-route="{{ route('kuesioner_detail.edit', $KuesionerDetail->id) }}"
                                                data-toggle="modal" data-target="#update">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            <form action="{{ route('kuesioner_detail.destroy', $KuesionerDetail->id) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger border-0 btn_delete"><i
                                                        class="far fa-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="update">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kuesioner</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="POST" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="callout callout-danger">
                                    <h5><i class="fas fa-warning "></i><b> Note:</b></h5>
                                    Inputan dengan tanda (<span class="text-red">*</span>) harus di isi.
                                </div>
                                <div class="form-group mb-1">
                                    <label>Jenis Monev</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-code-fork"></i></span>
                                        </div>
                                        <input type="text" value="{{ $KuesionerMasters->monev_master->nm_monev }}"
                                            name="no_standar_spmi" class="form-control form-control-sm text-bold" disabled
                                            required>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Pertanyaan <span>*</span></label>
                                    <textarea name="pertanyaan_m" class="form-control form-control-sm @error('pertanyaan_m') is-invalid @enderror"
                                        id="pertanyaan_m"></textarea>
                                    @error('pertanyaan_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Jawaban A <span>*</span></label>
                                    <input type="text" name="jawaban_1_m"
                                        class="form-control form-control-sm @error('jawaban_1_m') is-invalid @enderror"
                                        placeholder="Input Jawaban" required>
                                    @error('jawaban_1_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Jawaban B <span>*</span></label>
                                    <input type="text" name="jawaban_2_m"
                                        class="form-control form-control-sm @error('jawaban_2_m') is-invalid @enderror"
                                        placeholder="Input Jawaban" required>
                                    @error('jawaban_2_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Jawaban C <span>*</span></label>
                                    <input type="text" name="jawaban_3_m"
                                        class="form-control form-control-sm @error('jawaban_3_m') is-invalid @enderror"
                                        placeholder="Input Jawaban" required>
                                    @error('jawaban_3_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Jawaban D <span>*</span></label>
                                    <input type="text" name="jawaban_4_m"
                                        class="form-control form-control-sm @error('jawaban_4_m') is-invalid @enderror"
                                        placeholder="Input Jawaban" required>
                                    @error('jawaban_4_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Jawaban E <span>*</span></label>
                                    <input type="text" name="jawaban_5_m"
                                        class="form-control form-control-sm @error('jawaban_5_m') is-invalid @enderror"
                                        placeholder="Input Jawaban">
                                    @error('jawaban_5_m')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="kuesioner_master_id_m" value="{{ $KuesionerMasters->id }}"
                                    class="form-control form-control-sm @error('kuesioner_master_id_m') is-invalid @enderror"
                                    required readonly>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-sm btn-dark">
                                    <i class="far fa-circle-check"></i> Update
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
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('layouts.message')
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('#pertanyaan'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#pertanyaan_m'))
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(".btn_delete").click(function() {
            swal({
                    title: "Are you sure?",
                    text: "You Want to Delete this Data...?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.form.submit();
                        swal("Deleted Successfully", {
                            icon: "success",
                        });
                    }
                });

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
            let url = $(el).data('route');
            $.get(url, function(data) {
                // console.log(data);
                let update = "{{ url('kuesioner_detail') }}" + '/' + data.id;
                //console.log(update);
                // $('#update CKEDITOR.instances[name=pertanyaan_m]').val(data.pertanyaan);
                $('#update CKEDITOR.instances.pertanyaan_m').text(data.pertanyaan);
                $('#update input[name=jawaban_1_m]').val(data.jawaban_1);
                $('#update input[name=jawaban_2_m]').val(data.jawaban_2);
                $('#update input[name=jawaban_3_m]').val(data.jawaban_3);
                $('#update input[name=jawaban_4_m]').val(data.jawaban_4);
                $('#update input[name=jawaban_5_m]').val(data.jawaban_5);
                $('#update form').attr('action', update);
            });
        }
    </script>
@endsection
