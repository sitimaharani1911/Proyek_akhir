@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Tambah Pelaporan Kegiatan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('pelaporan.index') }}" class="text-muted text-hover-primary">Pelaporan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('kegiatan.index', ['proposal_id' => encrypt($proposal_id)]) }}"
                                class="text-muted text-hover-primary">List Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('kegiatan.tambah', ['list_kegiatan_id' => $list_kegiatan_id]) }}"
                                class="text-muted text-hover-primary">Tambah</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Tambah Pelaporan Kegiatan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    @if ($pelaporan)
                        <div class="alert alert-success">
                            <strong>Perhatian!</strong> Anda sudah pernah mengisi pelaporan untuk kegiatan ini
                        </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Tanggal Pelaporan</label><br>
                                <div class="form-control">
                                    {{ \Carbon\Carbon::parse($pelaporan->tanggal)->translatedFormat('d F Y') }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Status Pelaksanaan</label><br>
                                <div class="form-control">{{ $pelaporan->status_pelaksanaan }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Jumlah Peserta</label><br>
                                <div class="form-control">{{ $pelaporan->jumlah_peserta }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Absensi Peserta</label><br>
                                <div class="form-control">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <a href="{{ asset('storage/' . $pelaporan->absensi_peserta) }}" target="_blank"
                                        class="text-primary">Lihat Absensi</a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Pengajuan Dana</label><br>
                                <div class="form-control">Rp {{ number_format($pelaporan->pengajuan_dana, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Penggunaan Dana</label><br>
                                <div class="form-control">Rp {{ number_format($pelaporan->penggunaan_dana, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Sisa Dana</label><br>
                                <div class="form-control">Rp {{ number_format($pelaporan->sisa_dana, 0, ',', '.') }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Jumlah Luaran</label><br>
                                <div class="form-control">{{ $pelaporan->jumlah_luaran }}
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Satuan Luaran</label><br>
                                <div class="form-control">{{ $pelaporan->satuan_luaran }}
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Luaran Kegiatan</label><br>
                                <div class="form-control">{{ $pelaporan->luaran_kegiatan }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Link Luaran</label><br>
                                <div class="form-control">
                                    <a href="{{ $pelaporan->link_luaran }}" target="_blank"
                                        class="text-primary">{{ $pelaporan->link_luaran }}</a>
                                </div>
                            </div>

                            {{-- Dokumen --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold">Surat Keputusan</label><br>
                                <div class="form-control">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <a href="{{ asset('storage/' . $pelaporan->surat_keputusan) }}" target="_blank"
                                        class="text-primary">Lihat Surat Keputusan</a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Surat Tugas</label><br>
                                <div class="form-control">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <a href="{{ asset('storage/' . $pelaporan->surat_tugas) }}" target="_blank"
                                        class="text-primary">Lihat Surat Tugas</a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Laporan Kegiatan</label><br>
                                <div class="form-control">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <a href="{{ asset('storage/' . $pelaporan->laporan_kegiatan) }}" target="_blank"
                                        class="text-primary">Lihat Laporan Kegiatan</a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Laporan Keuangan</label><br>
                                <div class="form-control">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}" target="_blank"
                                        class="text-primary">Lihat Laporan Keuangan</a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Dampak</label><br>
                                <div class="form-control">{{ $pelaporan->dampak }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Dokumentasi</label><br>
                                <div class="form-control">
                                    <a href="{{ $pelaporan->dokumentasi }}" target="_blank"
                                        class="text-primary">{{ $pelaporan->dokumentasi }}</a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Lainnya</label><br>
                                <div class="form-control">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <a href="{{ asset('storage/' . $pelaporan->lainnya) }}" target="_blank"
                                        class="text-primary">Lihat Dokumen Lainnya</a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Bukti Pembayaran</label><br>
                                <div class="form-control">
                                    <a href="{{ $pelaporan->bukti_pembayaran }}" target="_blank"
                                        class="text-primary">{{ $pelaporan->bukti_pembayaran }}</a>
                                </div>
                            </div>
                    @else
                    <form class="row"
                        action="{{ route('kegiatan.store', ['list_kegiatan_id' => $list_kegiatan_id]) }}" method="POST"
                        id="formAdd" enctype="multipart/form-data">
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
                        <input type="hidden" name="list_kegiatan_id" value="{{ $list_kegiatan_id }}">

                        {{-- Kiri --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggal Pelaporan <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status Pelaksanaan Kegiatan<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="status_pelaksanaan"
                                    placeholder="Input Status Pelaksanaan" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jumlah Peserta <span
                                        class="text-danger">*</span></label>
                                <input type="string" class="form-control" placeholder="Jumlah Peserta"
                                    name="jumlah_peserta" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Absensi Peserta <span
                                        class="text-danger">*</span></label>
                                <input type="file" accept=".pdf" class="form-control" name="absensi_peserta" />
                                <span class="text-danger">Max. Size: 5 MB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pengajuan Dana <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Pengajuan Dana"
                                    name="pengajuan_dana" />
                                <span class="text-danger">Ket: Pastikan nominal yang diinput benar</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Penggunaan Dana<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="penggunaan_dana"
                                    placeholder="Penggunaan Dana" />
                                <span class="text-danger">Ket: Pastikan nominal yang diinput benar</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Sisa Dana <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Sisa Dana" name="sisa_dana" />
                                <span class="text-danger">Ket: Pastikan nominal yang diinput benar</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jumlah Luaran<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Input Jumlah Luaran"
                                    name="jumlah_luaran" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Satuan Luaran<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="satuan_luaran"
                                    placeholder="Input Satuan Luaran" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Luaran Kegiatan<span
                                        class="text-danger">*</span></label>
                                <input type="string" class="form-control" placeholder="Input Luaran Kegiatan"
                                    name="luaran_kegiatan" />
                            </div>
                        </div>

                        {{-- Kanan --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Link Luaran<span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" name="link_luaran"
                                    placeholder="Input Link Luaran" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Surat Keputusan <span
                                        class="text-danger">*</span></label>
                                <input type="file" accept=".pdf" class="form-control" name="surat_keputusan" />
                                <span class="text-danger">Max. Size: 5 MB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Surat Tugas <span
                                        class="text-danger">*</span></label>
                                <input type="file" accept=".pdf" class="form-control" name="surat_tugas" />
                                <span class="text-danger">Max. Size: 5 MB | Filetype: PDF</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Laporan Kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="file" accept=".pdf" class="form-control" name="laporan_kegiatan" />
                                <span class="text-danger">Max. Size: 5 MB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Laporan Keuangan <span
                                        class="text-danger">*</span></label>
                                <input type="file" accept=".pdf" class="form-control" name="laporan_keuangan" />
                                <span class="text-danger">Max. Size: 5 MB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Dampak <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Dampak" name="dampak" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Dokumentasi <span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" placeholder="https://drive.google.com/drive"
                                    name="dokumentasi" />
                                <span class="text-danger">Ket: Pastikan link dapat diakses</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Lainnya <span class="text-danger">*</span></label>
                                <input type="file" accept=".pdf" class="form-control" name="lainnya" />
                                <span class="text-danger">Max. Size: 5 MB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Bukti Pembayaran <span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" placeholder="https://gdrive.com"
                                    name="bukti_pembayaran" />
                                <span class="text-danger">Ket: Lampirkan seluruh bukti pembayaran</span>
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="mb-3 text-end mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    @endif
                </div>


            </div>
        </div>
    </div>
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
@endsection
