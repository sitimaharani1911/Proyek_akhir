@extends('layouts.master')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card-body py-3">
                <div class="card mb-2 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Detail Pengajuan Proposal</h3>
                        </div>
                        <a href="{{ route('proposal.index') }}" class="btn btn-sm btn-primary align-self-center">Kembali</a>
                    </div>
                    <div class="card-body p-9">
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Skema Hibah</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">Lorem</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Nama Pengaju</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9 fv-row">
                                <span class="fw-semibold">CF</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Judul Proposal
                            </label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span class="fw-semibold">Lorem</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Status</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span
                                    class="badge badge-light-warning flex-shrink-0 align-self-center py-3 px-4 fs-7 fw-semibold">Pengajuan</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Persetujuan PIU</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span
                                    class="badge badge-light-success flex-shrink-0 align-self-center py-3 px-4 fs-7 fw-semibold">Diterima</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-2 fw-bold fs-6 text-gray-800">Persetujuan Direktur</label>
                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                            <div class="col-lg-9">
                                <span
                                    class="badge badge-light-warning flex-shrink-0 align-self-center py-3 px-4 fs-7 fw-semibold">Pending</span>
                            </div>
                        </div>
                        @if (Auth::user()->role == 'Sentra' || Auth::user()->role == 'superadmin')
                            <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="">
                                <div class="row mb-7">
                                    <label class="col-lg-2 fw-bold fs-6 text-gray-800">Catatan</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-6">
                                        <textarea name="catatan" placeholder="Catatan" autocomplete="off" class="form-control bg-transparent"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-2 fw-bold fs-6 text-gray-800">Nilai</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" placeholder="Nilai" name="nilai" />
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-2 fw-bold fs-6 text-gray-800"></label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800"></label>
                                    <div class="col-lg-6">
                                        <a href="#" onclick="save()" class="btn btn-primary btn-sm">
                                            Simpan
                                        </a>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="row mb-7">
                                <label class="col-lg-2 fw-bold fs-6 text-gray-800">Catatan</label>
                                <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-lg-9">
                                    <span class="fw-semibold">-</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-2 fw-bold fs-6 text-gray-800">Nilai</label>
                                <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-lg-9">
                                    <span class="fw-semibold">-</span>
                                </div>
                            </div>
                            @if (Auth::user()->role == 'PIU' || Auth::user()->role == 'superadmin')
                                <div class="row mb-7">
                                    <label class="col-lg-2 fw-bold fs-6 text-gray-800">Persetujuan PIU</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-9">
                                        <div class="col-3">
                                            <select name="progres" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true" data-placeholder="Status">
                                                <option></option>
                                                <option value="1" selected>Diterima</option>
                                                <option value="2">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (Auth::user()->role == 'Direktur' || Auth::user()->role == 'superadmin')
                                <div class="row mb-7">
                                    <label class="col-lg-2 fw-bold fs-6 text-gray-800">Persetujuan Direktur</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-9">
                                        <div class="col-3">
                                            <select name="progres" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true" data-placeholder="Status">
                                                <option></option>
                                                <option value="1">Diterima</option>
                                                <option value="2">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <a href="" class="text-gray-800 text-hover-primary d-flex flex-column">
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <a href="" class="text-gray-800 text-hover-primary d-flex flex-column">
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <a href="" class="text-gray-800 text-hover-primary d-flex flex-column">
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <a href="" class="text-gray-800 text-hover-primary d-flex flex-column">
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
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <a href="" class="text-gray-800 text-hover-primary d-flex flex-column">
                                            <div class="symbol symbol-60px mb-5">
                                                <img src="{{ asset('themes/media/svg/files/blank-image.svg') }}"
                                                    class="theme-light-show" alt="" />
                                                <img src="{{ asset('themes/media/svg/files/blank-image-dark.svg') }}"
                                                    class="theme-dark-show" alt="" />
                                            </div>
                                            <div class="fs-5 fw-bold mb-2">Bukti SS</div>
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
