@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Laporan Keuangan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('laporan-keuangan.index') }}" class="text-muted text-hover-primary">Laporan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('laporan-keuangan.kegiatan', ['proposal_id' => $proposal_id]) }}"
                                class="text-muted text-hover-primary">Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Data Kegiatan Pelaksanaan Hibah</span>
                    </h3>
                    <div class="d-flex align-items-center position-relative my-1">
                        <select name="tahun" id="filter_tahun" class="form-control w-150px" required>
                            <option value="">Pilih Tahun</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <input type="hidden" id="proposal_id" value="{{ $encryptedId }}">
                        <table id="dtKegiatan" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 px-7 text-center">
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Ketua Pelaksana</th>
                                    <th>Tempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                {{-- @forelse ($kegiatans as $kegiatan)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kegiatan->proposal->informasi_hibah->nama_hibah }}</td>
                                        <td>{{ $kegiatan->proposal->ketua_hibah }}</td>
                                        <td>{{ $kegiatan->tempat_pelaksanaan }}</td>
                                        <td>
                                            <a
                                                href="{{ route('laporan-keuangan.review', ['list_kegiatan_id' => $kegiatan->id]) }}">
                                                <i class="fa fa-edit text-success" style="margin-right: 10px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Data Tidak Ada</td>
                                    </tr>
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        var method = '';
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let typingTimer;
            let doneTypingInterval = 250;
            var tahun = '';

            let dtKegiatan = $('#dtKegiatan').DataTable({
                responsive: true,
                paging: true,
                bDestroy: true,
                searching: true,
                ordering: false,
                lengthChange: true,
                autoWidth: false,
                aaSorting: [],
                serverSide: true,
                processing: true,
                language: {
                    lengthMenu: "Show _MENU_"
                },
                dom: "<'row mb-2'" +
                    "<'col-sm-6 d-flex align-items-center justify-content-start dt-toolbar'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                ajax: {
                    type: 'POST',
                    url: "{{ route('laporan-keuangan.data-kegiatan') }}",
                    data: function(d) {
                        d.tahun = tahun; // sudah ada
                        d.proposal_id = $('#proposal_id').val(); // ⬅️ kirim id
                    }
                },

                columns: [{
                        orderable: false,
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '20px',
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan',

                    },
                    {
                        data: 'ketua_hibah',
                        name: 'ketua_hibah',

                    },
                    {
                        data: 'tempat_pelaksanaan',
                        name: 'tempat_pelaksanaan',

                    },
                    {
                        orderable: false,
                        data: 'aksi',
                        className: 'text-center'
                    },
                ]
            });
            //filter
            $('#filter_tahun').change(function(e) {
                tahun = $('#filter_tahun').val();
                dtKegiatan.draw();
                e.preventDefault();
            });
        });
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
