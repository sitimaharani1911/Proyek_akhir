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
                    <div class="d-flex flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative my-1">
                            <select name="tahun" id="filter_tahun" class="form-control w-150px" required>
                                <option value="">Pilih Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if (Auth::user()->role == 'Sentra' || Auth::user()->role == 'superadmin')
                            <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                    onclick="add_ajax()">
                                    <i class="ki-duotone ki-plus fs-2"></i>
                                    Tambah
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="dtInformasiHibah"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Skema Hibah</th>
                                    <th>Mitra</th>
                                    <th>Kriteria</th>
                                    <th>Periode Pengajuan</th>
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
    <div class="modal fade" id="modalInformasiHibah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modal_title">Title</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form class="form" action="" method="POST" id="formInformasiHibah"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Nama Hibah</span>
                            </label>
                            <input type="text" class="form-control" placeholder="Nama" name="nama_hibah" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Skema Hibah</span>
                            </label>
                            <select name="skema_hibah" class="form-control" required>
                                <option value="">Pilih Skema</option>
                                @foreach ($skema_hibah as $value)
                                    <option value="{{ $value->skema }}">{{ $value->skema }}</option>
                                @endforeach
                            </select>
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
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Sistem Informasi" />
                                <label class="form-check-label">
                                    Sistem Informasi
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Teknik Informatika" />
                                <label class="form-check-label">
                                    Teknik Informatika
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Teknologi Rekayasa Komputer" />
                                <label class="form-check-label">
                                    Teknologi Rekayasa Komputer
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Akutansi Perpajakan" />
                                <label class="form-check-label">
                                    Akutansi Perpajakan
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Humas dan Komunikasi Digital" />
                                <label class="form-check-label">
                                    Humas dan Komunikasi Digital
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Bisnis Digital" />
                                <label class="form-check-label">
                                    Bisnis Digital
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Teknik Elektronika Telekomunikasi" />
                                <label class="form-check-label">
                                    Teknik Elektronika Telekomunikasi
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Teknik Listrik" />
                                <label class="form-check-label">
                                    Teknik Listrik
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Teknik Mesin" />
                                <label class="form-check-label">
                                    Teknik Mesin
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Teknologi Rekayasa Jaringan Telekomunikasi" />
                                <label class="form-check-label">
                                    Teknologi Rekayasa Jaringan Telekomunikasi
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Teknologi Rekayasa Sistem Elektronika" />
                                <label class="form-check-label">
                                    Teknologi Rekayasa Sistem Elektronika
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="prodi_terlibat[]"
                                    value="Teknologi Rekayasa Mekatronika" />
                                <label class="form-check-label">
                                    Teknologi Rekayasa Mekatronika
                                </label>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Kriteria</span>
                            </label>
                            <textarea name="kriteria" placeholder="Kriteria" autocomplete="off" class="form-control"></textarea>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Periode Pengajuan Mulai</span>
                            </label>
                            <input type="date" class="form-control" placeholder="Periode Pengajuan"
                                name="periode_pengajuan_awal" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Periode Pengajuan Akhir</span>
                            </label>
                            <input type="date" class="form-control" placeholder="Periode Pengajuan"
                                name="periode_pengajuan_akhir" />
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span>File Pendukung</span>
                            </label>
                            <input type="file" class="form-control" name="file_pendukung" />
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
            var tahun = '';

            let dtInformasiHibah = $('#dtInformasiHibah').DataTable({
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
                    url: "{{ route('informasi_hibah-list') }}",
                    data: function(d) {
                        d.tahun = tahun;
                    }
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
                        data: 'mitra',
                        name: 'mitra',
                    },
                    {
                        data: 'kriteria',
                        name: 'kriteria',
                    },
                    {
                        data: 'periode_pengajuan',
                        name: 'periode_pengajuan',
                    },
                    {
                        orderable: false,
                        data: 'action',
                        className: 'text-center'
                    },
                ]
            });

            //filter
            $('#filter_tahun').change(function(e) {
                tahun = $('#filter_tahun').val();
                dtInformasiHibah.draw();
                e.preventDefault();
            });
        });

        function resetForm() {
            $('#formInformasiHibah')[0].reset();
            $('[name="prodi_terlibat[]"]').prop('checked', false);
            $('[name="skema_hibah"] :selected').removeAttr('selected');
        }

        function add_ajax() {
            method = 'add';
            resetForm();
            $('#modal_title').html("Tambah Hibah");
            $('#modalInformasiHibah').modal('show');
        }

        function save() {
            let url;

            if (method === 'add') {
                url = "{{ route('informasi_hibah.store') }}";
            } else {
                url = "{{ route('informasi_hibah.update') }}";
            }

            const formData = new FormData($('#formInformasiHibah')[0]);
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
                        $('#modalInformasiHibah').modal('hide');
                        $('#dtInformasiHibah').DataTable().ajax.reload(null, false);
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
            $('#modal_title').html("Edit Hibah");

            $.ajax({
                url: "{{ url('informasi_hibah/edit') }}/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data.data) {
                        $('#formInformasiHibah')[0].reset();
                        $('[name="id"]').val(data.data.id);
                        $('[name="nama_hibah"]').val(data.data.nama_hibah);
                        $('[name="skema_hibah"]').val(data.data.skema_hibah).change();
                        $('[name="mitra"]').val(data.data.mitra);
                        $('[name="kriteria"]').val(data.data.kriteria);
                        $('[name="periode_pengajuan_awal"]').val(data.data.periode_pengajuan_awal);
                        $('[name="periode_pengajuan_akhir"]').val(data.data.periode_pengajuan_akhir);

                        // Handle multiple checkboxes for prodi_terlibat
                        if (data.data.prodi_terlibat) {
                            let prodiArray = data.data.prodi_terlibat.split(', ');
                            $('[name="prodi_terlibat[]"]').each(function() {
                                if (prodiArray.includes($(this).val())) {
                                    $(this).prop('checked', true);
                                } else {
                                    $(this).prop('checked', false);
                                }
                            });
                        }
                        $('#modalInformasiHibah').modal('show');
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
                        url: "{{ url('informasi_hibah') }}/" + id,
                        type: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status === true) {
                                $('#dtInformasiHibah').DataTable().ajax.reload(null, false);
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
