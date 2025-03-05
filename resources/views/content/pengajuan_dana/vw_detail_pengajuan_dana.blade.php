@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    Detail Pengajuan Dana</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('pengajuan_dana.index')}}" class="text-muted text-hover-primary">Pengajuan Dana</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('pengajuan_dana.kegiatan')}}" class="text-muted text-hover-primary">Kegiatan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('pengajuan_dana.show')}}" class="text-muted text-hover-primary">Detail Pengajuan Dana</a>
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
        <div class="card-body py-3">
            <div class="card mb-2 mb-xl-10" id="kt_profile_details_view">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Detail Pengajuan Dana</h3>
                    </div>
                    <a href="{{ route('pengajuan_dana.kegiatan') }}"
                        class="btn btn-sm btn-primary align-self-center">Kembali</a>
                </div>
                <div class="card-body p-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Dana Mitra</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">lorem</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Dana Pemberi</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Lorem</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Dana Pendamping</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Lorem</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">No Rekening</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">034235523084</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Keterangan</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Lorem</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Status</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Diterima</span>
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