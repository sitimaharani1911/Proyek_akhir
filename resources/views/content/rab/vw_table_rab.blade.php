@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        RAB</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">RAB</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Data RAB</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    @if (Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin')
                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" onclick="add_ajax()">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                Tambah
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="dtRab" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>Nama Hibah</th>
                                    <th>Skema Hibah</th>
                                    <th>Judul Proposal</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalRab" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="m_modal_title">Title</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form class="form" action="" method="POST" id="formRab" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2"><span
                                    class="required">Proposal</span></label>
                            <select name="proposal_id" class="form-control" required>
                                <option value="">Pilih Proposal</option>
                                @foreach ($proposal as $value)
                                    <option value="{{ $value->id }}">{{ $value->judul_proposal }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Tujuan</span>
                            </label>
                            <input type="text" class="form-control" placeholder="Tujuan" name="tujuan" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span>File RAB</span>
                            </label>
                            <input type="file" class="form-control" name="file_rab" />
                             <div class="text-muted fs-7 mt-2">
                                File yang didukung: xls, xlsx |
                                <span class="text-danger">Max: 10 MB</span>
                            </div>
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
        var method = '';
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let typingTimer;
            let doneTypingInterval = 250;

            let dtRab = $('#dtRab').DataTable({
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
                    url: "{{ route('rab-list') }}"
                },
                columns: [{
                        orderable: false,
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '20px',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_hibah',
                        name: 'nama_hibah',
                    },
                    {
                        data: 'skema_hibah',
                        name: 'skema_hibah',
                    },
                    {
                        data: 'judul_proposal',
                        name: 'judul_proposal',
                    },
                    {
                        data: 'tujuan',
                        name: 'tujuan',
                    },
                    {
                        data: 'status_internal',
                        name: 'status_internal',
                    },
                    {
                        orderable: false,
                        data: 'action',
                        className: 'text-center'
                    },
                ]
            });
        });

        function resetForm() {
            $('#formRab')[0].reset();
            $('[name="proposal_id"] :selected').removeAttr('selected');
        }

        function add_ajax() {
            method = 'add';
            resetForm();
            $('#m_modal_title').html("Tambah RAB");
            $('#modalRab').modal('show');
        }

        function save() {
            let url;

            if (method === 'add') {
                url = "{{ route('rab.store') }}";
            } else {
                url = "{{ route('rab.update') }}";
            }

            const formData = new FormData($('#formRab')[0]);
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', csrfToken);

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                    if (data.status) {
                        $('#modalRab').modal('hide');
                        $('#dtRab').DataTable().ajax.reload(null, false);
                        resetForm()
                        Swal.fire({
                            text: "Data Berhasil Disimpan",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    } else {
                        Swal.fire({
                            text: data.message,
                            icon: 'warning'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Oops", "Data gagal disimpan!", "error");
                }
            });
        }

        function edit(id) {
            method = 'edit';
            resetForm();
            $('#m_modal_title').html("Edit RAB");
            $.ajax({
                url: "{{ url('rab/edit') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data.data) {
                        $('#formRab')[0].reset();
                        $('[name="id"]').val(data.data.id);
                        $('[name="tujuan"]').val(data.data.tujuan);
                        $('[name="proposal_id"]').val(data.data.proposal_id).change();
                        $('#modalRab').modal('show');
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

        function hapus(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Anda yakin ingin hapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "<span><i class='flaticon-interface-1'></i><span>Ya, Hapus!</span></span>",
                confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--icon",
                cancelButtonText: "<span><i class='flaticon-close'></i><span>Batal Hapus</span></span>",
                cancelButtonClass: "btn btn-metal m-btn m-btn--pill m-btn--icon",
                customClass: {
                    confirmButton: 'btn btn-danger m-btn m-btn--pill m-btn--icon',
                    cancelButton: 'btn btn-metal m-btn m-btn--pill m-btn--icon'
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('rab') }}/" + id,
                        type: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status === true) {
                                $('#dtRab').DataTable().ajax.reload(null, false);
                                resetForm()
                                Swal.fire({
                                    text: "Data Berhasil Dihapus",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                })
                            } else {
                                Swal.fire("Oops", "Data gagal dihapus!", "error");
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire("Oops", "Data gagal dihapus!", "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection
