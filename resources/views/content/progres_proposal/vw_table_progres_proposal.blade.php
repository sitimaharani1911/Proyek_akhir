@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Progres Proposal</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Progres Proposal</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Data Pengajuan Proposal</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive" style="overflow-x: auto; position: relative;">
                        <table id="dtProgresProposal"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>Judul Proposal</th>
                                    <th>Nama Hibah</th>
                                    <th>Skema Hibah</th>
                                    <th>Ketua Hibah</th>
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
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // CSS mengatur untuk dropdown
            $('<style>').text(`
                .table-responsive .dropdown-menu {
                    position: fixed !important;
                    z-index: 9999 !important;
                }
            `).appendTo('head');

            $(document).on('show.bs.dropdown', '.table-responsive .dropdown', function(e) {
                var $dropdown = $(this).find('.dropdown-menu');
                var btnOffset = $(this).offset();
                var tableOffset = $(this).closest('.table-responsive').offset();
                var bodyScrollTop = $(window).scrollTop();

                $dropdown.css({
                    'top': (btnOffset.top + $(this).outerHeight() - bodyScrollTop) + 'px',
                    'left': btnOffset.left + 'px'
                });

                e.stopPropagation();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.table-responsive .dropdown-menu.show').removeClass('show');
                }
            });

            let typingTimer;
            let doneTypingInterval = 250;
            let dtProgresProposal = $('#dtProgresProposal').DataTable({
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
                    url: "{{ route('progres_proposal-list') }}"
                },
                columns: [{
                        orderable: false,
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '20px',
                        className: 'text-center'
                    },
                    {
                        data: 'judul_proposal',
                        name: 'judul_proposal',
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
                        data: 'ketua_hibah',
                        name: 'ketua_hibah',
                    },
                    {
                        data: 'status_eksternal',
                        name: 'status_eksternal',
                    },
                    {
                        orderable: false,
                        data: 'action',
                        width: 80,
                        className: 'text-center'
                    },
                ]
            });

            // Status Progres
            $(document).on('click', '.btn-statusProgres', function() {
                data = $(this).data()

                $.ajax({
                    type: "post",
                    url: "{{ url('verifikasi-status') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('#dtProgresProposal').DataTable().ajax.reload(null, false);
                        Swal.fire({
                            text: "Status Progres Berhasil diubah",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            });
        });
    </script>
@endsection
