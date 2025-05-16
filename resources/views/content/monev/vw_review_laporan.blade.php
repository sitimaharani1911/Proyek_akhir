@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Review Laporan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('monev.index') }}" class="text-muted text-hover-primary">Monev</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('monev.index') }}" class="text-muted text-hover-primary">Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('monev.index') }}" class="text-muted text-hover-primary">Review</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Review Laporan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    @forelse ($pelaporans as $pelaporan)
                        <form class="row" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="pelaporan_id" value="{{ $pelaporan->id }}">
                            <!-- section kiri -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Kegiatan</label>
                                    <textarea type="text" class="form-control mt-1"readonly>{{ $pelaporan->list_kegiatan->nama_kegiatan }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Ketua Pelaksana</label>
                                    <input type="text" class="form-control mt-1" value="{{ $pelaporan->list_kegiatan->proposal->ketua_hibah }}" readonly/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Anggota Pelaksana</label>
                                    <input type="text" class="form-control mt-1" value="{{ $pelaporan->anggota_pelaksana }}" readonly/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tanggal</label>
                                    <input type="text" class="form-control mt-1" value="{{ $pelaporan->tanggal }}" readonly/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tempat</label>
                                    <input type="text" class="form-control mt-1" value="{{ $pelaporan->tempat }}" readonly/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Jumlah Peserta</label>
                                    <input type="text" class="form-control mt-1" value="{{ $pelaporan->jumlah_peserta }}" readonly/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Absensi Peserta</label>
                                    <div class="col-md-7 form-control">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        <a href="{{ asset('storage/' . $pelaporan->absensi_peserta) }}" target="_blank">
                                            <span class="fw-semibold text-primary">Open </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Pengajuan Dana</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-1" value="{{ $pelaporan->pengajuan_dana }}" readonly/>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1" placeholder="Catatan Pengajuan Dana"
                                        name="catatan_pengajuan_dana" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Sisa Dana</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-1" value="{{ $pelaporan->sisa_dana }}" readonly/>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none"
                                        placeholder="Catatan Pengajuan Dana" name="catatan_sisa_dana" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Surat Kerja</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_kerja) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none"
                                        placeholder="Catatan Pengajuan Dana" name="catatan_surat_kerja" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Surat Tugas</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_tugas) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none"
                                        placeholder="Catatan Pengajuan Dana" name="catatan_surat_tugas" />
                                </div>
                            </div>
                            <!-- Section Kanan -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Laporan Kegiatan</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_kegiatan) }}"
                                                target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none" placeholder="Catatan Pengajuan Dana" 
                                        name="catatan_laporan_kegiatan" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Laporan Keuangan</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}"
                                                target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none" placeholder="Catatan Pengajuan Dana" 
                                        name="catatan_laporan_keuangan" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Luaran</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-1" value="{{ $pelaporan->luaran }}" readonly/>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none" placeholder="Catatan Pengajuan Dana" 
                                        name="catatan_luaran" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Dampak</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-1" value="{{ $pelaporan->dampak }}" readonly/>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none" placeholder="Catatan Pengajuan Dana" 
                                        name="catatan_dampak" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Dokumentasi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mt-1" value="{{ $pelaporan->dokumentasi }}" readonly/>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none" placeholder="Catatan Pengajuan Dana" 
                                        name="catatan_dokumentasi" />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Lainnya</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->lainnya) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <span class="input-group-text">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="bi bi-x-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control mt-1 d-none" placeholder="Catatan Pengajuan Dana" 
                                        name="catatan_lainnya" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nilai <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Nilai" name="nilai" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Persentase Capaian <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Persentase Capaian"
                                        name="persentase_capaian" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status">
                                        <option value="open">Open</option>
                                        <option value="close">Close</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Laporan Monen <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="laporan_monev" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tim Monev <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Tim Monev"
                                        name="tim_monev" />
                                </div>
                            </div>

                            <div class="col-12 text-end mt-4">
                                <button type="button" onclick="save()" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    @empty
                        <div class="alert alert-info">
                            <strong>Belum Ada Laporan</strong>
                        </div>
                    @endforelse
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
