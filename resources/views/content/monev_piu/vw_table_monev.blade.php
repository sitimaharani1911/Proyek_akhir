@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    Verifikasi Monitoring dan Evaluasi</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('piu.index')}}" class="text-muted text-hover-primary">Verifikasi Monev</a>
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
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Data Pelaksanaan Hibah</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                        <thead class="border">
                            <tr class="fw-bold fs-6 text-gray-800 px-7 text-center">
                                <th>No</th>
                                <th>Nama Hibah</th>
                                <th>Skema Hibah</th>
                                <th>Nama Pengaju</th>
                                <th>Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody class="border">
                            @forelse ( $proposals as $proposal )
                            <tr class="">
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $proposal->informasi_hibah->nama_hibah }}</td>
                                <td>{{ $proposal->informasi_hibah->skema_hibah }}</td>
                                <td>{{ $proposal->ketua_hibah }}</td>
                                <td class="text-primary"><a href="{{route('piu.kegiatan', ['proposal_id' => $proposal->id]) }}">Detail</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak Ada Data Hibah</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
