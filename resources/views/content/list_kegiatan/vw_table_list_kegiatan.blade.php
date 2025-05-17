@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        List Kegiatan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list-kegiatan.index') }}" class="text-muted text-hover-primary">Data Hibah</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list-kegiatan.data', ['proposal_id' => $proposal_id]) }}"
                                class="text-muted text-hover-primary">List Kegiatan</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Daftar Kegiatan</span>
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
                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <a href="{{ route('list-kegiatan.tambah', ['proposal_id' => $proposal_id]) }}" type="button"
                                class="btn btn-primary er fs-6 px-4 py-2">
                                <i class="ki-outline ki-plus fs-2"></i> Tambah
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <input type="hidden" id="proposal_id" value="{{ $encryptedId }}">
                        <table id="dtKegiatan" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 text-center align-middle">
                                    <th style="width: 40px;">No</th>
                                    <th style="width: 150px;">Jenis Hibah</th>
                                    <th style="width: 150px;">Program Studi</th>
                                    <th style="width: 150px;">Jenis Aktivitas</th>
                                    <th style="width: 250px;">Nama Kegiatan (Sesuai dengan proposal)</th>
                                    <th style="width: 100px;">Jumlah Luaran</th>
                                    <th style="width: 120px;">Satuan Luaran</th>
                                    <th style="width: 200px;">Luaran Kegiatan</th>
                                    <th style="width: 180px;">Status Pelaksanaan Kegiatan</th>
                                    <th style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                {{-- @forelse ($listKegiatan as $kegiatan)
                                    <tr class="">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kegiatan->jenis_hibah }}</td>
                                        <td>{{ $kegiatan->program_studi }}</td>
                                        <td>{{ $kegiatan->jenis_aktivitas }}</td>
                                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                                        <td>{{ $kegiatan->jumlah_luaran }}</td>
                                        <td>{{ $kegiatan->satuan_luaran }}</td>
                                        <td>{{ $kegiatan->luaran_kegiatan }}</td>
                                        <td>{{ $kegiatan->status_pelaksanaan_kegiatan }}</td>
                                        <td>Rp {{ number_format($kegiatan->total_anggaran_pengajuan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($kegiatan->total_anggaran_penggunaan, 0, ',', '.') }}</td>
                                        <td>{{ $kegiatan->tanggal_awal }}</td>
                                        <td>{{ $kegiatan->tanggal_akhir }}</td>
                                        <td>{{ $kegiatan->rentang_pengerjaan }} Bulan</td>
                                        <td>{{ $kegiatan->panitia_pengerjaan }}</td>
                                        <td>{{ $kegiatan->rincian_jumlah_peserta }}</td>
                                        <td>{{ $kegiatan->tempat_pelaksanaan }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $kegiatan->surat_kerja) }}" target="_blank">
                                                Lihat Surat Kerja
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/' . $kegiatan->surat_tugas) }}" target="_blank">
                                                Lihat Surat Tugas
                                            </a>
                                        </td>

                                        <td class="text-primary">
                                            <!-- Tombol untuk memicu modal -->
                                            @if ($kegiatan->template_laporan)
                                                <a href="{{ asset('storage/' . $kegiatan->template_laporan) }}"
                                                    target="_blank">Download</a>
                                            @else
                                                <span class="text-danger">Belum ada template</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('list-kegiatan.edit', ['id' => $kegiatan->id]) }}">
                                                <i class="fa fa-edit text-success" style="margin-right: 10px;"></i>
                                            </a>
                                            <form action="{{ route('list-kegiatan.destroy', ['id' => $kegiatan->id]) }}"
                                                method="POST" style="display: inline;" class="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-btn" data-id="{{ $kegiatan->id }}"
                                                    data-nama="{{ $kegiatan->nama_kegiatan }}"
                                                    style="border: none; background: none; color: red; cursor: pointer;">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Belum ada kegiatan untuk proposal ini.</td>
                                    </tr>
                                @endforelse --}}

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
                    url: "{{ route('list-kegiatan.data-kegiatan') }}",
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
                        data: 'jenis_hibah',
                        name: 'jenis_hibah',
                        
                    },
                    {
                        data: 'program_studi',
                        name: 'program_studi',
                        
                    },
                    {
                        data: 'jenis_aktivitas',
                        name: 'jenis_aktivitas',
                        
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan',
                        
                    },
                    {
                        data: 'jumlah_luaran',
                        name: 'jumlah_luaran',
                        
                    },
                    {
                        data: 'satuan_luaran',
                        name: 'satuan_luaran',
                        
                    },
                    {
                        data: 'luaran_kegiatan',
                        name: 'luaran_kegiatan',
                        
                    },
                    {
                        data: 'status_pelaksanaan_kegiatan',
                        name: 'status_pelaksanaan_kegiatan',
                        
                    },
                    {
                        orderable: false,
                        data: 'aksi',
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
