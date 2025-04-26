@extends('layouts.master')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card-body py-3">
                <div class="card mb-2 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Detail Proposal</h3>
                        </div>
                        <a href="{{ route('pengesahan_berkas.index') }}"
                            class="btn btn-sm btn-primary align-self-center">Kembali</a>
                    </div>
                    <div class="card-body p-9">
                        <div class="row">
                            <!-- Left side - Details -->
                            <div class="col-lg-6 border-end pe-7">
                                <div class="row mb-7">
                                    <label class="col-lg-3 fw-bold fs-6 text-gray-800">Skema Hibah</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold">{{ $data->informasi_hibah->skema_hibah }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-3 fw-bold fs-6 text-gray-800">Judul Proposal</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold">{{ $data->judul_proposal }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-3 fw-bold fs-6 text-gray-800">Status Internal</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-8">
                                        {!! convertStatus($data->status_internal)['badge'] !!}
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-3 fw-bold fs-6 text-gray-800">Persetujuan Piu</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-8">
                                        {!! convertStatus($data->persetujuan_piu)['badge'] !!}
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-3 fw-bold fs-6 text-gray-800">Persetujuan Direktur</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-8">
                                        {!! convertStatus($data->persetujuan_direktur)['badge'] !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Right side - Form/Notes -->
                            <div class="col-lg-6 ps-7">
                                <div class="row mb-7">
                                    <label class="col-lg-3 fw-bold fs-6 text-gray-800">Catatan</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold">{{ $data->catatan ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-3 fw-bold fs-6 text-gray-800">Nilai</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-8">
                                        <span class="badge badge-pill badge-success">{{ $data->nilai ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                            @if ($data->file_proposal)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_proposal) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column" target="_blank">
                                                <div class="symbol symbol-60px mb-5">
                                                    <img src="{{ asset('themes/media/svg/files/pdf.svg') }}"
                                                        class="theme-light-show" alt="" />
                                                    <img src="{{ asset('themes/media/svg/files/pdf-dark.svg') }}"
                                                        class="theme-dark-show" alt="" />
                                                </div>
                                                <div class="fs-5 fw-bold mb-2">File Proposal</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($data->file_rab)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_rab) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column" target="_blank">
                                                <div class="symbol symbol-60px mb-5">
                                                    <img src="{{ asset('themes/media/svg/files/pdf.svg') }}"
                                                        class="theme-light-show" alt="" />
                                                    <img src="{{ asset('themes/media/svg/files/pdf-dark.svg') }}"
                                                        class="theme-dark-show" alt="" />
                                                </div>
                                                <div class="fs-5 fw-bold mb-2">File RAB</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($data->file_sk)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_sk) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column" target="_blank">
                                                <div class="symbol symbol-60px mb-5">
                                                    <img src="{{ asset('themes/media/svg/files/pdf.svg') }}"
                                                        class="theme-light-show" alt="" />
                                                    <img src="{{ asset('themes/media/svg/files/pdf-dark.svg') }}"
                                                        class="theme-dark-show" alt="" />
                                                </div>
                                                <div class="fs-5 fw-bold mb-2">Surat Keputusan</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($data->file_st)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_st) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column" target="_blank">
                                                <div class="symbol symbol-60px mb-5">
                                                    <img src="{{ asset('themes/media/svg/files/pdf.svg') }}"
                                                        class="theme-light-show" alt="" />
                                                    <img src="{{ asset('themes/media/svg/files/pdf-dark.svg') }}"
                                                        class="theme-dark-show" alt="" />
                                                </div>
                                                <div class="fs-5 fw-bold mb-2">Surat Tugas</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($data->file_kontrak)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_kontrak) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column"
                                                target="_blank">
                                                <div class="symbol symbol-60px mb-5">
                                                    <img src="{{ asset('themes/media/svg/files/pdf.svg') }}"
                                                        class="theme-light-show" alt="" />
                                                    <img src="{{ asset('themes/media/svg/files/pdf-dark.svg') }}"
                                                        class="theme-dark-show" alt="" />
                                                </div>
                                                <div class="fs-5 fw-bold mb-2">File Kontrak</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($data->file_berita_acara)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_berita_acara) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column"
                                                target="_blank">
                                                <div class="symbol symbol-60px mb-5">
                                                    <img src="{{ asset('themes/media/svg/files/pdf.svg') }}"
                                                        class="theme-light-show" alt="" />
                                                    <img src="{{ asset('themes/media/svg/files/pdf-dark.svg') }}"
                                                        class="theme-dark-show" alt="" />
                                                </div>
                                                <div class="fs-5 fw-bold mb-2">Berita Acara</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($data->file_pendukung)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_pendukung) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column"
                                                target="_blank">
                                                <div class="symbol symbol-60px mb-5">
                                                    <img src="{{ asset('themes/media/svg/files/blank-image.svg') }}"
                                                        class="theme-light-show" alt="" />
                                                    <img src="{{ asset('themes/media/svg/files/blank-image-dark.svg') }}"
                                                        class="theme-dark-show" alt="" />
                                                </div>
                                                <div class="fs-5 fw-bold mb-2">File Pendukung</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
