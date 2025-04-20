@extends('layouts.master')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card-body py-3">
                <div class="card mb-2 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Detail RAB</h3>
                        </div>
                        <a href="{{ route('rab.index') }}" class="btn btn-sm btn-primary align-self-center">Kembali</a>
                    </div>
                    <div class="card-body p-9">
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Nama Hibah</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">{{ $data->proposal->informasi_hibah->nama_hibah }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Skema Hibah</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9 fv-row">
                                <span class="fw-semibold">{{ $data->proposal->informasi_hibah->skema_hibah }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Judul Proposal</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">{{ $data->proposal->judul_proposal }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Tujuan
                            </label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">{{ $data->tujuan }}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Status</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                {!! convertStatus($data->proposal->status_internal)['badge'] !!}
                            </div>
                        </div>
                        @php
                            $fileUrl = Storage::url($data->file_rab);
                            $extension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                            $isPdf = strtolower($extension) === 'pdf';
                            $isDownloadable = in_array(strtolower($extension), ['xls', 'xlsx', 'doc', 'docx']);
                        @endphp

                        <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <a href="{{ $fileUrl }}"
                                            class="text-gray-800 text-hover-primary d-flex flex-column"
                                            @if ($isPdf) target="_blank"
                                            @elseif($isDownloadable)
                                            download @endif>
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
