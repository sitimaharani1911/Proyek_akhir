@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Data Kegiatan Pelaksanaan Hibah</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('monev-kegiatan.index')}}" class="text-muted text-hover-primary">Data Pelaksanaan Hibah</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('monev-kegiatan.data', ['proposal_id' => encrypt($proposal_id)]) }}"
                                class="text-muted text-hover-primary">List Kegiatan</a>
                        </li>
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
                    <div class="d-flex align-items-center position-relative my-1">
                        <select name="tahun" id="filter_tahun" class="form-control w-150px" required>
                            <option value="">Pilih Tahun</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <input type="hidden" id="proposal_id" value="{{ $encryptedId }}">
                        <table id="dtKegiatan" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 text-center align-middle">
                                    <th style="width: 40px;">No</th>
                                    <th style="width: 250px;">Nama Kegiatan</th>
                                    <th style="width: 150px;">Ketua Pelaksana Kegiatan</th>
                                    <th style="width: 150px;">Jenis Aktivitas</th>
                                    <th style="width: 150px;">Tempat Pelaksanaan</th>
                                    <th style="width: 130px;">Template Laporan</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($kegiatans as $kegiatan)
        <div class="modal fade" id="unggahModal{{ $kegiatan->id }}" tabindex="-1"
            aria-labelledby="unggahModalLabel{{ $kegiatan->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('template-laporan.store', $kegiatan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="unggahModalLabel{{ $kegiatan->id }}">Unggah Template Laporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="template_laporan" class="form-label">File Template</label>
                                <input type="file" name="template_laporan" class="form-control" required
                                    accept=".pdf,.doc,.docx">
                            </div>
                            @if ($kegiatan->template_laporan)
                                <p class="mt-2">Saat ini:
                                    <a href="{{ asset('storage/' . $kegiatan->template_laporan) }}" target="_blank">Lihat
                                        Template</a>
                                </p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
@section('js')
    <script>
        // Notifikasi jika ada error validasi
        @if ($errors->any())
            Swal.fire({
                title: 'Error!',
                text: 'Periksa kembali form Anda.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
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

            let dtKegiatan = $('#dtKegiatan').DataTable({
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
                    url: "{{ route('monev-kegiatan.data-kegiatan') }}",
                    data: function(d) {
                        d.tahun = tahun; // sudah ada
                        d.proposal_id = $('#proposal_id').val(); // ⬅️ kirim id
                    }
                },

                columns: [{
                        orderable: false,
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '20px',
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan',

                    },
                    {
                        data: 'ketua_pelaksana_kegiatan',
                        name: 'ketua_pelaksana_kegiatan',

                    },
                    {
                        data: 'jenis_aktivitas',
                        name: 'jenis_aktivitas',

                    },
                    {
                        data: 'tempat_pelaksanaan',
                        name: 'tempat_pelaksanaan',

                    },
                    {
                        orderable: false,
                        data: 'template_laporan',
                        className: 'text-center'
                    }
                ]
            });
            //filter
            $('#filter_tahun').change(function(e) {
                tahun = $('#filter_tahun').val();
                dtKegiatan.draw();
                e.preventDefault();
            });
        });
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

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
                        url: "{{ url('list-kegiatan/destroy') }}/" + id,
                        type: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status === true) {
                                $('#dtKegiatan').DataTable().ajax.reload(null, false);
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
