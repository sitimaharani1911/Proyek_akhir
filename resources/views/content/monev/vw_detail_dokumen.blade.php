@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    Detail Dokumen</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('monev.index')}}" class="text-muted text-hover-primary">Monev</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('monev.dokumen')}}" class="text-muted text-hover-primary">Detail Dokumen</a>
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
                    <span class="card-label fw-bold fs-3 mb-1">Data Informasi Hibah</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="d-flex mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                            <span class="required">Verifikasi Kelayakan</span>
                        </label>
                        <div class="col-md-7">
                            <i class="bi bi-file-earmark-pdf"></i>
                            <span class="fw-semibold">Open </span>
                        </div>
                    </div>
                    <div class="d-flex mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                            <span class="required">Kerangka Acuan Kerja</span>
                        </label>
                        <div class="col-md-7">
                            <i class="bi bi-file-earmark-pdf"></i>
                            <span class="fw-semibold">Open </span>
                        </div>
                    </div>
                    <div class="d-flex mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                            <span class="required">SK Tim Hibah</span>
                        </label>
                        <div class="col-md-7">
                            <i class="bi bi-file-earmark-pdf"></i>
                            <span class="fw-semibold">Open </span>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="#" onclick="save()" class="btn btn-primary ">
                            Tutup
                        </a>
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