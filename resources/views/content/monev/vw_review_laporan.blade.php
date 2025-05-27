@extends('layouts.master')
@section('content')
<style>
    i.bi{
        stroke-width: 2;
    }
</style>
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
                        <form class="row" action="{{ route('monev.review.store', ['pelaporan_id' => $pelaporan->id]) }}"
                            method="POST" id="formAdd" enctype="multipart/form-data">
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
                                    <textarea type="text" class="form-control"readonly>{{ $pelaporan->list_kegiatan->nama_kegiatan }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Ketua Pelaksana</label>
                                    <input type="text" class="form-control"
                                        value="{{ $pelaporan->list_kegiatan->proposal->ketua_hibah }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Anggota Pelaksana</label>
                                    <input type="text" class="form-control" value="{{ $pelaporan->list_kegiatan->panitia_pengerjaan}}"
                                        readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tanggal</label>
                                    <input type="text" class="form-control" value="{{ $pelaporan->tanggal }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tempat</label>
                                    <input type="text" class="form-control" value="{{ $pelaporan->list_kegiatan->tempat_pelaksanaan }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Jumlah Peserta</label>
                                    <input type="text" class="form-control" value="{{ $pelaporan->jumlah_peserta }}"
                                        readonly />
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
                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Pengajuan Dana</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $pelaporan->pengajuan_dana }}"
                                            readonly />
                                        <label for="pengajuan-dana-terima" class="input-group-text">
                                            <input type="radio" id="pengajuan-dana-terima" name="status_pengajuan_dana"
                                                value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="pengajuan-dana-tolak" class="input-group-text">
                                            <input type="radio" id="pengajuan-dana-tolak" name="status_pengajuan_dana"
                                                value="Ditolak" class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Pengajuan Dana" name="catatan_pengajuan_dana" />
                                </div>
                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Sisa Dana</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $pelaporan->sisa_dana }}"
                                            readonly />
                                        <label for="sisa-dana-terima" class="input-group-text">
                                            <input type="radio" id="sisa-dana-terima" name="status_sisa_dana"
                                                value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="sisa-dana-tolak" class="input-group-text">
                                            <input type="radio" id="sisa-dana-tolak" name="status_sisa_dana"
                                                value="Ditolak" class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Sisa Dana" name="catatan_sisa_dana" />
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Surat Kerja</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_kerja) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <label for="surat-kerja-terima" class="input-group-text">
                                            <input type="radio" id="surat-kerja-terima" name="status_surat_kerja"
                                                value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="surat-kerja-tolak" class="input-group-text">
                                            <input type="radio" id="surat-kerja-tolak" name="status_surat_kerja"
                                                value="Ditolak" class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Surat Kerja" name="catatan_surat_kerja" />
                                </div>
                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Surat Tugas</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_tugas) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <label for="surat-tugas-terima" class="input-group-text">
                                            <input type="radio" id="surat-tugas-terima" name="status_surat_tugas"
                                                value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="surat-tugas-tolak" class="input-group-text">
                                            <input type="radio" id="surat-tugas-tolak" name="status_surat_tugas"
                                                value="Ditolak" class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Surat Tugas" name="catatan_surat_tugas" />
                                </div>
                            </div>
                            <!-- Section Kanan -->
                            <div class="col-md-6">
                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Laporan Kegiatan</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_kegiatan) }}"
                                                target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <label for="laporan-kegiatan-terima" class="input-group-text">
                                            <input type="radio" id="laporan-kegiatan-terima"
                                                name="status_laporan_kegiatan" value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="laporan-kegiatan-tolak" class="input-group-text">
                                            <input type="radio" id="laporan-kegiatan-tolak"
                                                name="status_laporan_kegiatan" value="Ditolak" class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Laporan Kegiatan" name="catatan_laporan_kegiatan" />
                                </div>
                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Laporan Keuangan</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}"
                                                target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <label for="laporan-keuangan-terima" class="input-group-text">
                                            <input type="radio" id="laporan-keuangan-terima"
                                                name="status_laporan_keuangan" value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="laporan-keuangan-tolak" class="input-group-text">
                                            <input type="radio" id="laporan-keuangan-tolak"
                                                name="status_laporan_keuangan" value="Ditolak" class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Keuangan" name="catatan_laporan_keuangan" />
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Luaran</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $pelaporan->luaran }}"
                                            readonly />
                                        <label for="luaran-terima" class="input-group-text">
                                            <input type="radio" id="luaran-terima" name="status_luaran"
                                                value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="luaran-tolak" class="input-group-text">
                                            <input type="radio" id="luaran-tolak" name="status_luaran" value="Ditolak"
                                                class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Luaran" name="catatan_luaran" />
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Dampak</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $pelaporan->dampak }}"
                                            readonly />
                                        <label for="dampak-terima" class="input-group-text">
                                            <input type="radio" id="dampak-terima" name="status_dampak"
                                                value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="dampak-tolak" class="input-group-text">
                                            <input type="radio" id="dampak-tolak" name="status_dampak" value="Ditolak"
                                                class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Dampak" name="catatan_dampak" />
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Dokumentasi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $pelaporan->dokumentasi }}"
                                            readonly />
                                        <label for="dokumentasi-terima" class="input-group-text">
                                            <input type="radio" id="dokumentasi-terima" name="status_dokumentasi"
                                                value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="dokumentasi-tolak" class="input-group-text">
                                            <input type="radio" id="dokumentasi-tolak" name="status_dokumentasi"
                                                value="Ditolak" class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Dokumentasi" name="catatan_dokumentasi" />
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Lainnya</label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->lainnya) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                        <label for="lainnya-terima" class="input-group-text">
                                            <input type="radio" id="lainnya-terima" name="status_lainnya"
                                                value="Diterima" class="d-none" />
                                            <i class="bi bi-check-circle-fill"></i>
                                        </label>
                                        <label for="lainnya-tolak" class="input-group-text">
                                            <input type="radio" id="lainnya-tolak" name="status_lainnya"
                                                value="Ditolak" class="d-none" />
                                            <i class="bi bi-x-circle-fill"></i>
                                        </label>
                                    </div>
                                    <input id="catatan" type="text" class="form-control d-none mt-2"
                                        placeholder="Catatan Lainnya" name="catatan_lainnya" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nilai <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Nilai" name="nilai" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Persentase Capaian <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Persentase Capaian"
                                        name="persentase_capaian" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="status">
                                        <option value="open">Open</option>
                                        <option value="close">Close</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Laporan Monen <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="laporan_monev" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tim Monev <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Tim Monev"
                                        name="tim_monev" />
                                </div>
                            </div>

                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-primary">Kirim</button>
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
    <script>
        const groups = document.querySelectorAll('.group-catatan');

        groups.forEach(group => {
            const terimaButton = group.querySelector('[id*="-terima"]');
            const tolakButton = group.querySelector('[id*="-tolak"]');

            const terimaLabel = group.querySelector('label[for*="-terima"] .bi');
            const tolakLabel = group.querySelector('label[for*="-tolak"] .bi');

            const catatanInput = group.querySelector('#catatan');

            const updateStyles = () => {
                // Reset colors
                terimaLabel.style.color = '';
                tolakLabel.style.color = '';

                catatanInput.value = '';

                if (terimaButton.checked) {
                    terimaLabel.style.color = '#059669';
                    catatanInput.classList.add('d-none');
                }

                if (tolakButton.checked) {
                    tolakLabel.style.color = 'red';
                    catatanInput.classList.remove('d-none');
                }
            };

            // Run once on page load
            updateStyles();

            // Add event listeners
            terimaButton.addEventListener('change', updateStyles);
            tolakButton.addEventListener('change', updateStyles);
        });
    </script>
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
@endsection
