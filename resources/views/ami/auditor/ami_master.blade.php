@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('title', 'SI-IMUT | Audit Standar SPMI')
@section('content')

    <div class="col-md-12">
        <div class="card card-outline card-gray-dark">
            <div class="card-header">
                <h3 class="card-title">Audit Standar SPMI</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        <a href="{{ route('ami_detail') }}" class="btn-sm btn-outline-danger"><i
                                class="fa fa-arrow-left"></i>
                            Kembali </a>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Standar SPMI</th>
                                <th class="text-center">Pernyataan</th>
                                <th class="text-center">Observasi</th>
                                <th class="text-center">Temuan</th>
                                <th class="text-center">Audite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AmiPeriodeMasters as $AmiPeriodeMaster)
                                <tr id="hide{{ $AmiPeriodeMaster->id }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $AmiPeriodeMaster->spmi_standar_master->no_standar_spmi }}.
                                        <strong>{{ $AmiPeriodeMaster->spmi_standar_master->nm_standar_spmi }}</strong>
                                    </td>
                                    <td>
                                        <div class="mt-0 mb-0">
                                            @foreach ($AmiPeriodeMaster->spmi_standar_master->spmi_standar_detail as $DetailStandar)
                                                <form action="{{ route('create_ami_detail') }}" method="get">
                                                    {{-- @csrf --}}
                                                    <input type="hidden"
                                                        value="{{ Crypt::encrypt($AmiPeriodeMaster->id) }}"
                                                        name="ami_periode_master_id"
                                                        class="form-control form-control-sm text-bold" readonly required>
                                                    <input type="hidden" value="{{ $DetailStandar->id }}"
                                                        name="spmi_standar_detail_id"
                                                        class="form-control form-control-sm text-bold" readonly required>
                                                    <button type="submit"
                                                        class="badge btn btn-outline-dark">{{ $DetailStandar->poin }}</button>
                                                    <span>{!! Str::limit(strip_tags($DetailStandar->pernyataan), $limit = 35, '..') !!}</span>
                                                </form>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            @foreach ($AmiPeriodeMaster->ami_periode_detail as $DetailAmi)
                                                <p class="mb-0">
                                                    @if ($DetailAmi->observasi)
                                                        <span
                                                            class="badge btn btn-outline-dark">{{ $DetailAmi->spmi_standar_detail->poin }}</span>
                                                    @endif
                                                </p>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            @foreach ($AmiPeriodeMaster->ami_periode_detail as $DetailAmi)
                                                <p class="mb-0">
                                                    @if ($DetailAmi->temuan == 'S')
                                                        <span
                                                            class="badge badge-info">{{ $DetailAmi->spmi_standar_detail->poin }}-{{ $DetailAmi->temuan }}</span>
                                                    @elseif ($DetailAmi->temuan == 'OB')
                                                        <span
                                                            class="badge badge-warning">{{ $DetailAmi->spmi_standar_detail->poin }}-{{ $DetailAmi->temuan }}</span>
                                                    @elseif ($DetailAmi->temuan == 'KTsM')
                                                        <span
                                                            class="badge badge-danger">{{ $DetailAmi->spmi_standar_detail->poin }}-{{ $DetailAmi->temuan }}</span>
                                                    @elseif ($DetailAmi->temuan == 'KTsMi')
                                                        <span
                                                            class="badge badge-danger">{{ $DetailAmi->spmi_standar_detail->poin }}-{{ $DetailAmi->temuan }}</span>
                                                    @endif
                                                </p>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mt-0 mb-0">
                                            @foreach ($AmiPeriodeMaster->ami_periode_detail as $DetailAmi)
                                                <p class="mb-0">
                                                    @if ($DetailAmi->rtk)
                                                        <span
                                                            class="badge btn btn-outline-dark">{{ $DetailAmi->spmi_standar_detail->poin }}</span>
                                                    @endif
                                                </p>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
