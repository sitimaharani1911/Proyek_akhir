@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Informasi Hibah</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Informasi Hibah</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">List</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn btn-primary er fs-6 px-4 py-2" onclick="add_ajax()">
                        <i class="ki-outline ki-plus fs-2"></i> Tambah
                    </button>
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
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Skema Hibah</th>
                                    <th>Mitra</th>
                                    <th>Prodi</th>
                                    <th>Kriteria</th>
                                    <th>Periode Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Lorem</td>
                                    <td>CF</td>
                                    <td>Lorem</td>
                                    <td>Sistem Informasi</td>
                                    <td>Lorem</td>
                                    <td>28/02/2025</td>
                                    <td><a href="{{ url('informasi_hibah/show/id') }}">
                                            <i class="fa fa-eye text-info" style="margin-right: 10px;"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="edit('1')">
                                            <i class="fa fa-edit text-success" style="margin-right: 10px;"></i>
                                        </a>
                                        <a href="javascript:void(0)" style="color: red;">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="m_modal_6" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="m_modal_6_title">Title</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nama</span>
                            </label>
                            <input type="text" class="form-control" placeholder="Nama" name="nama" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Skema Hibah</span>
                            </label>
                            <input type="text" class="form-control" placeholder="Skema Hibah" name="skema_hibah" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Mitra</span>
                            </label>
                            <input type="text" class="form-control" placeholder="Mitra" name="mitra" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"><span class="required">Program
                                    Studi</span></label>
                            <select name="program_studi" class="form-control" required>
                                <option value="">Pilih Program Studi</option>
                                <option value="1">Sistem Informasi</option>
                                <option value="2">Teknik Informatika</option>
                                <option value="3">Teknik Komputer</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Kriteria</span>
                            </label>
                            <textarea name="kriteria" placeholder="Kriteria" autocomplete="off" class="form-control"></textarea>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Periode Pengajuan</span>
                            </label>
                            <input type="date" class="form-control" placeholder="Periode Pengajuan"
                                name="periode_pengajuan" />
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                            <a href="#" onclick="save()" class="btn btn-primary ">
                                Simpan
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
