@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Tambah List Kegiatan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list-kegiatan.index') }}" class="text-muted text-hover-primary">Data Hibah</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list-kegiatan.data', ['proposal_id' => encrypt($proposal_id)]) }}"
                                class="text-muted text-hover-primary">List Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list-kegiatan.tambah', ['proposal_id' => $proposal_id]) }}"
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
                        <span class="card-label fw-bold fs-3 mb-1">Tambah List Kegiatan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <form class="row g-3" action="{{ route('list-kegiatan.store', ['proposal_id' => $proposal_id]) }}"
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
                        <input type="hidden" name="proposal_id" value="{{ $proposal_id }}">
                        <!-- SECTION KIRI -->
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Nama Kegiatan<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_kegiatan"
                                    placeholder="Input Nama Kegiatan" />
                                <span class="text-danger">Ket: Samakan dengan judul yang tertera di proposal</span>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Ketua Pelaksana Kegiatan<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="ketua_pelaksana_kegiatan"
                                    placeholder="Input Nama Ketua Pelaksana Kegiatan" />
                                <span class="text-danger">Ket: Inputkan nama lengkap, bukan inisial</span>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Jenis Aktivitas<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="jenis_aktivitas" required>
                                    <option value="" selected disabled>Pilih Jenis Aktivitas</option>
                                    <option value="Workshop">Workshop</option>
                                    <option value="Training dan Sertifikasi">Training dan Sertifikasi</option>
                                    <option value="Pengadaan">Pengadaan</option>
                                    <option value="Benchmark">Benchmark</option>
                                    <option value="FGD">FGD</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                    <option value="Rancang Bangun Mesin">Rancang Bangun Mesin</option>
                                    <option value="Pendampingan">Pendampingan</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Tempat Pelaksanaan<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Input Tempat Pelaksanaan"
                                    name="tempat_pelaksanaan" />
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Tanggal Awal <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" />
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Tanggal Akhir <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" />
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Rentang Pengerjaan<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Rentang Pengerjaan"
                                    name="rentang_pengerjaan" id="rentang_pengerjaan" readonly />
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Panitia Kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Input Panitia Kegiatan"
                                    name="panitia_pengerjaan" />
                                <span class="text-danger">Ket: Inisial Dosen, Jika lebih satu orang dipisah dengan koma
                                    (Cth: MSZ, IDI)</span>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Surat Keputusan<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="surat_keputusan" accept=".pdf" />
                                <span class="text-danger">Max. Size : 5 MB | Filetype : pdf</span>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Surat Tugas<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="surat_tugas" accept=".pdf" />
                                <span class="text-danger">Max. Size : 5 MB | Filetype : pdf</span>
                            </div>
                        </div>

                        <div class="col-12 text-end mt-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
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
    </script>
    <script>
        const tanggalAwal = document.getElementById('tanggal_awal');
        const tanggalAkhir = document.getElementById('tanggal_akhir');
        const rentangPengerjaan = document.getElementById('rentang_pengerjaan');

        function hitungRentangBulanHari() {
            const awal = new Date(tanggalAwal.value);
            const akhir = new Date(tanggalAkhir.value);

            if (!isNaN(awal) && !isNaN(akhir) && akhir >= awal) {
                let tahunSelisih = akhir.getFullYear() - awal.getFullYear();
                let bulanSelisih = (tahunSelisih * 12) + (akhir.getMonth() - awal.getMonth());

                // Hitung tanggal awal dalam bulan
                let hariSelisih = akhir.getDate() - awal.getDate();

                if (hariSelisih < 0) {
                    // Kalau tanggal akhir lebih kecil dari tanggal awal → kurangi 1 bulan dan hitung selisih hari dari bulan sebelumnya
                    bulanSelisih -= 1;
                    const akhirBulanSebelumnya = new Date(akhir.getFullYear(), akhir.getMonth(), 0)
                        .getDate(); // jumlah hari bulan sebelumnya
                    hariSelisih = akhirBulanSebelumnya - awal.getDate() + akhir.getDate();
                }

                // Minimal 0 bulan → kalau tanggal sama → tampilkan 0 Bulan 0 Hari
                bulanSelisih = bulanSelisih < 0 ? 0 : bulanSelisih;

                let hasil = '';
                if (bulanSelisih > 0) hasil += `${bulanSelisih} Bulan`;
                if (hariSelisih > 0) hasil += (hasil ? ' ' : '') + `${hariSelisih} Hari`;

                // Kalau tepat sebulan (misal 2025-01-01 ke 2025-02-01) → hanya tampil "1 Bulan"
                if (hasil === '') hasil = '0 Hari';

                rentangPengerjaan.value = hasil;
            } else {
                rentangPengerjaan.value = '';
            }
        }

        tanggalAwal.addEventListener('change', hitungRentangBulanHari);
        tanggalAkhir.addEventListener('change', hitungRentangBulanHari);
    </script>
@endsection
