@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        User</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">User</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Data User</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="d-flex flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <input type="text" data-kt-docs-table-filter="search"
                                class="form-control form-control-solid w-250px ps-15" placeholder="Search Users" />
                        </div>
                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" onclick="add_ajax()">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                Tambah
                            </button>
                        </div>
                    </div>
                    <table id="dtUser" class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
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
                            <input type="text" class="form-control" placeholder="Nama" name="name" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Username</span>
                            </label>
                            <input type="text" class="form-control" placeholder="Username" name="username" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Password</span>
                            </label>
                            <input type="password" class="form-control" placeholder="Password" name="password" />
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
    <div class="modal fade" id="m_modal_5" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="m_modal_5_title">Title</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form class="form" action="" method="POST" id="formAdd5" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                value="Adhoc" />
                                            <label class="m-checkbox m-checkbox--state-brand">
                                                Adhoc
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                value="Sentra" />
                                            <label class="m-checkbox m-checkbox--state-brand">
                                                Sentra
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                value="Pelaksana" />
                                            <label class="m-checkbox m-checkbox--state-brand">
                                                Pelaksana
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                value="Direktur" />
                                            <label class="m-checkbox m-checkbox--state-brand">
                                                Direktur
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                value="Kesekretariatan" />
                                            <label class="m-checkbox m-checkbox--state-brand">
                                                Kesekretariatan
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                value="PIU" />
                                            <label class="m-checkbox m-checkbox--state-brand">
                                                PIU
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                value="Monev" />
                                            <label class="m-checkbox m-checkbox--state-brand">
                                                Monev
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                value="Keuangan" />
                                            <label class="m-checkbox m-checkbox--state-brand">
                                                Keuangan
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                            <a href="#" onclick="save_role()" class="btn btn-primary ">
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

            let dtUser = $('#dtUser').DataTable({
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
                    paginate: {
                        previous: "<i class='fa-solid fa-angle-left'>",
                        next: "<i class='fa-solid fa-angle-right'>"
                    }
                },

                ajax: {
                    type: 'POST',
                    url: "{{ route('user-list') }}"
                },

                columns: [{
                        orderable: false,
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '20px',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'username',
                        name: 'username',
                    },
                    {
                        orderable: false,
                        data: 'action',
                        width: '80px',
                        className: 'text-center'
                    },
                ]
            });
            dtUser.on('draw.dt', function() {
                KTMenu.init();
            });
            $('input[data-kt-docs-table-filter="search"]').on('keyup', function(event) {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function() {
                    dtUser.search(event.target.value).draw();
                }, doneTypingInterval);
            });

        });

        function resetForm() {
            $('#formAdd')[0].reset();
        }

        function add_ajax() {
            method = 'add';
            resetForm();
            $('#m_modal_6_title').html("Tambah User");
            $('#m_modal_6').modal('show');
        }

        function save() {
            let url;

            if (method === 'add') {
                url = "{{ route('user.store') }}";
            } else {
                url = "{{ route('user.update') }}";
            }

            const formData = new FormData($('#formAdd')[0]);
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
                        $('#m_modal_6').modal('hide');
                        $('#dtUser').DataTable().ajax.reload(null, false);
                        resetForm()
                        Swal.fire({
                            title: "Berhasil..",
                            text: "Data Berhasil Disimpan",
                            icon: "success"
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
            $('#m_modal_6_title').html("Edit User");

            $.ajax({
                url: "{{ url('user/edit') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data.data) {
                        $('#formAdd')[0].reset();
                        $('[name="id"]').val(data.data.id);
                        $('[name="name"]').val(data.data.name);
                        $('[name="username"]').val(data.data.username);
                        $('#m_modal_6').modal('show');
                    } else {
                        Swal.fire("Oops", "Gagal mengambil data!", "error");
                    }
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
                        url: "{{ url('user') }}/" + id,
                        type: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status === true) {
                                $('#dtUser').DataTable().ajax.reload(null, false);
                                resetForm()
                                Swal.fire({
                                    title: "Berhasil..",
                                    text: "Data Berhasil Dihapus",
                                    icon: "success"
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

        function add_role(id) {
            $('#formAdd5')[0].reset();
            $('[name="user_id"]').val(id);
            $('#m_modal_5_title').html("Tambah Role");
            $('#m_modal_5').modal('show');

            $.ajax({
                url: "{{ url('user/get_role') }}/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.roles) {
                        $.each(response.roles, function(index, role) {
                            $('input[name="role[]"][value="' + role + '"]').prop('checked', true);
                        });
                    }
                    $('#m_modal_5').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("Oops", "Data gagal dihapus!", "error");
                }
            });
        }

        function save_role() {

            const formData = new FormData($('#formAdd5')[0]);
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', csrfToken);

            $.ajax({
                url: "{{ route('user.store_role') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                    if (data.status) {
                        $('#m_modal_5').modal('hide');
                        $('#dtUser').DataTable().ajax.reload(null, false);
                        resetForm()
                        Swal.fire({
                            title: "Berhasil..",
                            text: "Data Berhasil Disimpan",
                            icon: "success"
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
    </script>
@endsection
