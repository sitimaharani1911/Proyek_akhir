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
                        <span class="card-label fw-bold fs-3 mb-1">Laporan Keuangan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 px-7 text-center">
                                    <th>No</th>
                                    <th>Nama Hibah</th>
                                    <th>Ketua Pelaksana</th>
                                    <th>Tanggal</th>
                                    <th>Tempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                @forelse ($kegiatans as $kegiatan)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kegiatan->proposal->informasi_hibah->nama_hibah }}</td>
                                        <td>{{ $kegiatan->proposal->ketua_hibah }}</td>
                                        <td>04-03-2025</td>
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
                                @endforelse
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
        function resetForm() {
            $('#formAdd')[0].reset();
            $('[name="program_studi"] :selected').removeAttr('selected');
        }

        function add_ajax() {
            method = 'add';
            resetForm();
            $('#m_modal_6_title').html("Tambah Hibah");
            $('#m_modal_6').modal('show');
        }

        function edit(id) {
            method = 'edit';
            resetForm();
            $('#m_modal_6_title').html("Edit Hibah");

            $.ajax({
                url: "{{ url('informasi_hibah/edit') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data.data) {
                        $('#formAdd')[0].reset();
                        $('[name="id"]').val('1');
                        $('[name="nama"]').val('Lorem');
                        $('[name="skema_hibah"]').val('CF');
                        $('[name="mitra"]').val('Lorem');
                        $('[name="program_studi"]').val('1').change();
                        $('[name="kriteria"]').val('Lorem');
                        $('[name="periode_pengajuan"]').val('2025-02-21');
                        $('#m_modal_6').modal('show');
                    } else {
                        Swal.fire("Oops", "Gagal mengambil data!", "error");
                    }
                    mApp.unblockPage();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    mApp.unblockPage();
                    Swal.fire("Error", "Gagal mengambil data dari server!", "error");
                }
            });
        }
    </script>
@endsection
