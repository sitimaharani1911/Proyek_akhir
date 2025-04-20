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
                        <div class="row mb-7">
                            <div class="col-lg-5">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Surat Keputusan</span>
                                </label>
                                <input type="file" class="form-control" name="file_rab" />
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-lg-5">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Surat Tugas</span>
                                </label>
                                <input type="file" class="form-control" name="file_rab" />
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-lg-5">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">File Pendukung</span>
                                </label>
                                <input type="file" class="form-control" name="file_rab" />
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-lg-3">
                                <a href="{{ route('ttd_berkas.index') }}"
                                    class="btn btn-sm btn-primary align-self-center">Simpan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
