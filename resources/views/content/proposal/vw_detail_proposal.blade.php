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
                        <div class="row">
                            <!-- Left side - Details -->
                            <div class="col-lg-6 border-end pe-7">
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold fs-6 text-gray-800">Skema Hibah</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-7">
                                        <span class="fw-semibold">{{ $data->informasi_hibah->skema_hibah }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold fs-6 text-gray-800">Judul Proposal</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-7">
                                        <span class="fw-semibold">{{ $data->judul_proposal }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold fs-6 text-gray-800">Status Internal</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-7">
                                        @if (Auth::user()->role == 'Sentra' || Auth::user()->role == 'superadmin')
                                            @php
                                                switch ($data->status_internal) {
                                                    case 1:
                                                        $text = 'Pending';
                                                        $class = 'btn-warning';
                                                        break;
                                                    case 2:
                                                        $text = 'Pengajuan';
                                                        $class = 'btn-primary';
                                                        break;
                                                    case 3:
                                                        $text = 'Diterima';
                                                        $class = 'btn-success';
                                                        break;
                                                    case 0:
                                                    default:
                                                        $text = 'Ditolak';
                                                        $class = 'btn-danger';
                                                        break;
                                                }
                                            @endphp

                                            <button type="button"
                                                class="btn {{ $class }} btn-sm dropdown-toggle waves-effect"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ $text }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item btn-verifikasi" href="javascript:void(0);"
                                                    data-id="{{ $data->id }}" data-status="2"
                                                    data-verifikasi="status_internal" data-model="Proposal">Pengajuan</a>
                                                <a class="dropdown-item btn-verifikasi" href="javascript:void(0);"
                                                    data-id="{{ $data->id }}" data-status="3"
                                                    data-verifikasi="status_internal" data-model="Proposal">Diterima</a>
                                                <a class="dropdown-item btn-verifikasi" href="javascript:void(0);"
                                                    data-id="{{ $data->id }}" data-status="0"
                                                    data-verifikasi="status_internal" data-model="Proposal">Ditolak</a>
                                            </div>
                                        @else
                                            {!! convertStatus($data->status_internal)['badge'] !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold fs-6 text-gray-800">Persetujuan Piu</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-7">
                                        {!! convertStatus($data->persetujuan_piu)['badge'] !!}
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-bold fs-6 text-gray-800">Persetujuan Direktur</label>
                                    <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-lg-7">
                                        {!! convertStatus($data->persetujuan_direktur)['badge'] !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Right side - Form/Notes -->
                            <div class="col-lg-6 ps-7">
                                @if (Auth::user()->role == 'Sentra' || Auth::user()->role == 'superadmin')
                                    <form class="form" action="" method="POST" id="formNilaiProposal"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="row mb-7">
                                            <label class="col-lg-3 fw-bold fs-6 text-gray-800">Catatan</label>
                                            <div class="col-lg-9">
                                                <textarea name="catatan" placeholder="Catatan" autocomplete="off" class="form-control bg-transparent">{{ $data->catatan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-3 fw-bold fs-6 text-gray-800">Nilai</label>
                                            <div class="col-lg-9">
                                                <input type="number" class="form-control" placeholder="Nilai"
                                                    name="nilai" value="{{ $data->nilai }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-9">
                                                <a href="#" onclick="save()" class="btn btn-primary btn-sm">
                                                    Simpan
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                @else
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
                                    @if (Auth::user()->role == 'PIU' || Auth::user()->role == 'superadmin')
                                        <div class="row mb-7">
                                            <label class="col-lg-3 fw-bold fs-6 text-gray-800">Persetujuan Piu</label>
                                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                            <div class="col-lg-3">
                                                @php
                                                    switch ($data->persetujuan_piu) {
                                                        case 1:
                                                            $text = 'Pending';
                                                            $class = 'btn-warning';
                                                            break;
                                                        case 3:
                                                            $text = 'Diterima';
                                                            $class = 'btn-success';
                                                            break;
                                                        case 0:
                                                        default:
                                                            $text = 'Ditolak';
                                                            $class = 'btn-danger';
                                                            break;
                                                    }
                                                @endphp
                                                <button type="button"
                                                    class="btn {{ $class }} btn-sm dropdown-toggle waves-effect"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ $text }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item btn-verifikasi" href="javascript:void(0);"
                                                        data-id="{{ $data->id }}" data-status="3"
                                                        data-verifikasi="PIU" data-model="Proposal">Diterima</a>
                                                    <a class="dropdown-item btn-verifikasi" href="javascript:void(0);"
                                                        data-id="{{ $data->id }}" data-status="0"
                                                        data-verifikasi="PIU" data-model="Proposal">Ditolak</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role == 'Direktur' || Auth::user()->role == 'superadmin')
                                        <div class="row mb-5">
                                            <label class="col-lg-3 fw-bold fs-6 text-gray-800">Persetujuan Direktur</label>
                                            <label class="col-lg-1 fw-bold fs-6 text-gray-800">:</label>
                                            <div class="col-lg-3">
                                                @php
                                                    switch ($data->persetujuan_direktur) {
                                                        case 1:
                                                            $text = 'Pending';
                                                            $class = 'btn-warning';
                                                            break;
                                                        case 3:
                                                            $text = 'Diterima';
                                                            $class = 'btn-success';
                                                            break;
                                                        case 0:
                                                        default:
                                                            $text = 'Ditolak';
                                                            $class = 'btn-danger';
                                                            break;
                                                    }
                                                @endphp
                                                <button type="button"
                                                    class="btn {{ $class }} btn-sm dropdown-toggle waves-effect"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ $text }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item btn-verifikasi" href="javascript:void(0);"
                                                        data-id="{{ $data->id }}" data-status="3"
                                                        data-verifikasi="direktur" data-model="Proposal">Diterima</a>
                                                    <a class="dropdown-item btn-verifikasi" href="javascript:void(0);"
                                                        data-id="{{ $data->id }}" data-status="0"
                                                        data-verifikasi="direktur" data-model="Proposal">Ditolak</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                            @if ($data->file_proposal)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_proposal) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column"
                                                target="_blank">
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
                                                class="text-gray-800 text-hover-primary d-flex flex-column"
                                                target="_blank">
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
                                                class="text-gray-800 text-hover-primary d-flex flex-column"
                                                target="_blank">
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
                                                class="text-gray-800 text-hover-primary d-flex flex-column"
                                                target="_blank">
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
                            @if ($data->bukti_ss)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                            <a href="{{ Storage::url($data->file_st) }}"
                                                class="text-gray-800 text-hover-primary d-flex flex-column"
                                                target="_blank">
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Status Progres
            $(document).on('click', '.btn-verifikasi', function() {
                data = $(this).data()

                $.ajax({
                    type: "post",
                    url: "{{ url('verifikasi-status') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            text: "Data Berhasil Disimpan",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            });
        });

        function save() {
            const formData = new FormData($('#formNilaiProposal')[0]);
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', csrfToken);

            $.ajax({
                url: "{{ route('proposal.update_nilai') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                    if (data.status) {
                        Swal.fire({
                            text: "Data Berhasil Disimpan",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            text: data.message,
                            icon: 'warning'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Oops", "Data gagal disimpan!", "error");
                }
            });
        }
    </script>
@endsection
