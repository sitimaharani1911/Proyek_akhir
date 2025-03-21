@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    Tambah Pengajuan Dana</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('pengajuan_dana.index')}}" class="text-muted text-hover-primary">Pengajuan Dana</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('pengajuan_dana.kegiatan')}}" class="text-muted text-hover-primary">Kegiatan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('pengajuan_dana.tambah')}}" class="text-muted text-hover-primary">Tambah Kegiatan</a>
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
                    <span class="card-label fw-bold fs-3 mb-1">Form Pengajuan Dana Kegiatan</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <form class="row g-3" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" />
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Keterangan <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="keterangan" rows="4"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Tujuan Pengajuan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Tujuan Pengajuan" name="tujuan_pengajuan" />
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Nominal <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Nominal" name="nominal" />
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Laporan Pengajuan Dana <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="laporan_pengajuan_dana" />
                    </div>
                    <div class="col-12 text-end mt-5">
                        <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
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