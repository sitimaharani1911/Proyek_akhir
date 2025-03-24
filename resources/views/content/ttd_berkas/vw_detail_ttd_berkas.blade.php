@extends('layouts.master')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card-body py-3">
                <div class="card mb-2 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Berkas</h3>
                        </div>
                        <a href="{{ route('ttd_berkas.index') }}"
                            class="btn btn-sm btn-primary align-self-center">Kembali</a>
                    </div>
                    <div class="card-body p-9">
                        @if (Auth::user()->role == 'Kesekretariatan')
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Upload Dokumen yang Akan di Tanda
                                    Tangan</label>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-5">
                                    <span class="col-lg-6 fw-bold fs-6 text-gray-800">Unduh Dokumen</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <div class="col-lg-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Surat Keputusan</span>
                                    </label>
                                    <input type="file" class="form-control" name="file_rab" />
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Surat Keputusan</span>
                                    </label>
                                    <div class="d-flex flex-aligns-center">
                                        <img alt="" class="w-30px me-3"
                                            src="{{ asset('themes//media/svg/files/pdf.svg') }}" />
                                        <div class="ms-1 fw-semibold">
                                            <a href="" class="fs-6 text-hover-primary fw-bold">Unduh File</a>
                                            <div class="text-gray-500">Surat Keputusan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <div class="col-lg-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Surat Tugas</span>
                                    </label>
                                    <input type="file" class="form-control" name="file_rab" />
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Surat Tugas</span>
                                    </label>
                                    <div class="d-flex flex-aligns-center">
                                        <img alt="" class="w-30px me-3"
                                            src="{{ asset('themes//media/svg/files/pdf.svg') }}" />
                                        <div class="ms-1 fw-semibold">
                                            <a href="" class="fs-6 text-hover-primary fw-bold">Unduh File</a>
                                            <div class="text-gray-500">Surat Tugas</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <div class="col-lg-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">File Pendukung</span>
                                    </label>
                                    <input type="file" class="form-control" name="file_rab" />
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>File Pendukung</span>
                                    </label>
                                    <div class="d-flex flex-aligns-center">
                                        <img alt="" class="w-30px me-3"
                                            src="{{ asset('themes//media/svg/files/pdf.svg') }}" />
                                        <div class="ms-1 fw-semibold">
                                            <a href="" class="fs-6 text-hover-primary fw-bold">Unduh File</a>
                                            <div class="text-gray-500">File Pendukung</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <div class="col-lg-3">
                                    <a href="{{ route('ttd_berkas.index') }}"
                                        class="btn btn-sm btn-primary align-self-center">Simpan</a>
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-7">
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->role == 'PIU' || Auth::user()->role == 'Direktur')
                            <div class="row mb-7">
                                <label class="col-lg-3 fw-bold fs-6 text-gray-800">Unduh Dokumen Sebelum di TTD</label>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-7">
                                    <span class="col-lg-7 fw-bold fs-6 text-gray-800">Upload Dokumen Sesudah di TTD</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <div class="col-lg-3">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Surat Keputusan</span>
                                    </label>
                                    <div class="d-flex flex-aligns-center">
                                        <img alt="" class="w-30px me-3"
                                            src="{{ asset('themes//media/svg/files/pdf.svg') }}" />
                                        <div class="ms-1 fw-semibold">
                                            <a href="" class="fs-6 text-hover-primary fw-bold">Unduh File</a>
                                            <div class="text-gray-500">Surat Keputusan</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-7">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Surat Keputusan</span>
                                    </label>
                                    <input type="file" class="form-control" name="file_rab" />
                                </div>
                            </div>
                            <div class="row mb-7">
                                <div class="col-lg-3">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>Surat Tugas</span>
                                    </label>
                                    <div class="d-flex flex-aligns-center">
                                        <img alt="" class="w-30px me-3"
                                            src="{{ asset('themes//media/svg/files/pdf.svg') }}" />
                                        <div class="ms-1 fw-semibold">
                                            <a href="" class="fs-6 text-hover-primary fw-bold">Unduh File</a>
                                            <div class="text-gray-500">Surat Tugas</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-7">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Surat Tugas</span>
                                    </label>
                                    <input type="file" class="form-control" name="file_rab" />
                                </div>
                            </div>
                            <div class="row mb-7">
                                <div class="col-lg-3">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span>File Pendukung</span>
                                    </label>
                                    <div class="d-flex flex-aligns-center">
                                        <img alt="" class="w-30px me-3"
                                            src="{{ asset('themes//media/svg/files/pdf.svg') }}" />
                                        <div class="ms-1 fw-semibold">
                                            <a href="" class="fs-6 text-hover-primary fw-bold">Unduh File</a>
                                            <div class="text-gray-500">File Pendukung</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-7">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">File Pendukung</span>
                                    </label>
                                    <input type="file" class="form-control" name="file_rab" />
                                </div>
                            </div>
                            <div class="row mb-7">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-7">
                                    <a href="{{ route('ttd_berkas.index') }}"
                                        class="btn btn-sm btn-primary align-self-center">Simpan</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
