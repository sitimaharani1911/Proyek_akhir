@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Proposal</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Proposal</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">List</li>
                    </ul>
                </div>
                @if (Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin')
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <button type="button" class="btn btn-primary er fs-6 px-4 py-2" onclick="add_ajax()">
                            <i class="ki-outline ki-plus fs-2"></i> Tambah
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Data Pengajuan Proposal</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>Judul Proposal</th>
                                    <th>Nama Hibah</th>
                                    <th>Skema Hibah</th>
                                    <th>Ketua Hibah</th>
                                    <th>Abstrak</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Lorem</td>
                                    <td>Lorem</td>
                                    <td>CF</td>
                                    <td>Lorem</td>
                                    <td>Lorem</td>
                                    <td><span
                                            class="badge badge-light-warning flex-shrink-0 align-self-center py-3 px-4 fs-7">Pengajuan</span>
                                    </td>
                                    <td>
                                        <a href="{{ url('proposal/show/id') }}">
                                            <i class="fa fa-info-circle text-success fs-5" style="margin-right: 10px;"></i>
                                        </a>
                                        @if (Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin')
                                            <a href="{{ url('proposal/show/id') }}">
                                                <i class="fa fa-eye text-info fs-5" style="margin-right: 10px;"></i>
                                            </a>
                                            <a href="javascript:void(0)" onclick="edit('1')">
                                                <i class="fa fa-edit text-success fs-5" style="margin-right: 10px;"></i>
                                            </a>
                                            <a href="javascript:void(0)" style="color: red;">
                                                <i class="fas fa-trash text-danger fs-5"></i>
                                            </a>
                                        @endif
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
                                <span class="required">Judul Proposal</span>
                            </label>
                            <input type="text" class="form-control" placeholder="Judul" name="judul" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                    class="required">Hibah</span></label>
                            <select name="informasi_hibah_id" class="form-control" required>
                                <option value="">Pilih Hibah</option>
                                <option value="1">Lorem</option>
                                <option value="2">CF</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Ketua Hibah</span>
                            </label>
                            <input type="text" class="form-control" placeholder="Ketua Hibah" name="ketua_hibah" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Abstrak</span>
                            </label>
                            <textarea name="abstrak" placeholder="Abstrak" autocomplete="off" class="form-control"></textarea>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">File Proposal</span>
                            </label>
                            <input type="file" class="form-control" name="file" />
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
        $(document).ready(function() {
            let status = "{{ $status }}";
            let id = {{ $id }};
            if (status == 'apply') {
                $('[name="informasi_hibah_id"]').val(id).change();
                $('#m_modal_6_title').html("Tambah Pengajuan Proposal");
                $('#m_modal_6').modal('show');
            }
        });

        function resetForm() {
            $('#formAdd')[0].reset();
            $('[name="informasi_hibah_id"] :selected').removeAttr('selected');
        }

        function add_ajax() {
            method = 'add';
            resetForm();
            $('#m_modal_6_title').html("Tambah Pengajuan Proposal");
            $('#m_modal_6').modal('show');
        }

        function edit(id) {
            method = 'edit';
            resetForm();
            $('#m_modal_6_title').html("Edit Pengajuan Proposal");

            $.ajax({
                url: "{{ url('proposal/edit') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data.data) {
                        $('#formAdd')[0].reset();
                        $('[name="id"]').val('1');
                        $('[name="judul"]').val('Lorem');
                        $('[name="skema_hibah"]').val('CF');
                        $('[name="ketua_hibah"]').val('Lorem');
                        $('[name="abstrak"]').val('Lorem');
                        $('[name="informasi_hibah_id"]').val('1').change();
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
