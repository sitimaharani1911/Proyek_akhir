@extends('layouts.master')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card-body py-3">
                <div class="card mb-2 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Detail Informasi Hibah</h3>
                        </div>
                        <a href="{{ route('informasi_hibah.index') }}"
                            class="btn btn-sm btn-primary align-self-center">Kembali</a>
                    </div>
                    <div class="card-body p-9">
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Nama Hibah</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">{{ $data->nama_hibah }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Skema Hibah</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9 fv-row">
                                <span class="fw-semibold">{{ $data->skema_hibah }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Mitra
                            </label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">{{ $data->mitra }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Program Studi</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">{{ $data->prodi_terlibat }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Kriteria</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">{{ $data->kriteria }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Periode Pengajuan</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">{{ $data->periode_pengajuan_awal }} s/d
                                    {{ $data->periode_pengajuan_akhir }}</span>
                            </div>
                        </div>
                        <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <a href="{{ Storage::url($data->file_pendukung) }}"
                                            class="text-gray-800 text-hover-primary d-flex flex-column" target="_blank">
                                            <div class="symbol symbol-60px mb-5">
                                                <img src="{{ asset('themes/media/svg/files/upload.svg') }}"
                                                    class="theme-light-show" alt="" />
                                                <img src="{{ asset('themes/media/svg/files/upload-dark.svg') }}"
                                                    class="theme-dark-show" alt="" />
                                            </div>
                                            <div class="fs-5 fw-bold mb-2">File Pendukung</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->role == 'Adhoc' || Auth::user()->role == 'superadmin')
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <a href="{{ url('proposal/apply/' . encrypt($data->id)) }}"
                                        class="btn btn-sm btn-success align-self-center">Apply</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
