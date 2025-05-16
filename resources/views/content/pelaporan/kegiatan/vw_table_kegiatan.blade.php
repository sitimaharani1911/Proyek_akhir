@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Kegiatan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">Pelaporan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a  class="text-muted text-hover-primary">Kegiatan</a>
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
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 px-7 text-center">
                                    <th style="width: 40px;">No</th>
                                    <th style="width: 400px;">Nama Kegiatan</th>
                                    <th style="width: 150px;">Ketua Pelaksana</th>
                                    <th style="width: 200px;">Jenis Aktivitas</th>
                                    <th>Hasil Monev</th>
                                    <th>Hasil Review Keuangan</th>
                                    <th>Detail Laporan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                @forelse ($listKegiatan as $kegiatan)
                                    <tr class="">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kegiatan->proposal->judul_proposal ?? '-' }}</td>
                                        <td>{{ $kegiatan->proposal->ketua_hibah ?? '-' }}</td>
                                        <td>{{ $kegiatan->jenis_aktivitas }}</td>
                                        <td class="text-center"><a href="{{ route('kegiatan.hasilMonev') }}" class="text-primary text-center">Cek Hasil</a>
                                        </td>
                                        <td class="text-center text-primary"><a class="text-primary" href="{{ route('kegiatan.review_keuangan', ['list_kegiatan_id' => $kegiatan->id]) }}">Cek Hasil</a>
                                        </td>
                                        <td class="text-center"><a href="{{  route('pelaporan.show', ['list_kegiatan_id' => $kegiatan->id])  }}" class="text-primary text-center">Lihat Laporan</a>
                                        </td>
                                        <td class="text-center"><a href="{{  route('kegiatan.tambah', $kegiatan->id)  }}" class="text-primary text-center">Buat Laporan</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="21">Belum ada kegiatan untuk proposal ini.</td>
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
