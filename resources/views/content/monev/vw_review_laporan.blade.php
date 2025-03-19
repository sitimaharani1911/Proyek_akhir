@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    Review Laporan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('monev.index')}}" class="text-muted text-hover-primary">Monev</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('monev.index')}}" class="text-muted text-hover-primary">Kegiatan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('monev.index')}}" class="text-muted text-hover-primary">Review</a>
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
                    <span class="card-label fw-bold fs-3 mb-1">Review Laporan</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <form class="row" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <!-- section kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama_kegiatan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ketua Pelaksana <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Ketua Pelaksana" name="ketua_pelaksana" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Anggota Pelaksana <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Anggota Pelaksana" name="anggota_pelaksana" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pengajuan Dana <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Pengajuan Dana" name="pengajuan_dana" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sisa Dana <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Sisa Dana" name="sisa_dana" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Luaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Luaran" name="luaran" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Dampak <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Dampak" name="dampak" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tempat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tempat" name="tempat" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Peserta <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Jumlah Peserta" name="jumlah_peserta" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Absensi Peserta <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="absensi_peserta" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Surat Kerja <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="surat_kerja" />
                        </div>

                    </div>
                    <!-- Section Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Surat Tugas <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="surat_tugas" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Laporan Kegiatan <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="laporan_kegiatan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Laporan Keuangan <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="laporan_keuangan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Dokumentasi <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" placeholder="Dokumentasi" name="dokumentasi" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Lainnya <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="lainnya" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Catatan" name="catatan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nilai <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Nilai" name="nilai" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Persentase Capaian <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Persentase Capaian" name="persentase_capaian" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="open">Open</option>
                                <option value="close">Close</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tim Monev <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tim Monev" name="tim_monev" />
                        </div>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="button" onclick="save()" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
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