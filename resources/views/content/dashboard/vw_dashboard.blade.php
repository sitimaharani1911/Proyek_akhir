@extends('layouts.master')
@section('content')
    <style>
        .apexcharts-bar-series path[fill="#6751f5"] {
            transform: scaleY(15);
            /* paksa tampil biar bisa dilihat */
            transform-origin: bottom;
        }
    </style>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    {{-- Warna Biru Gelap - Dark Slate Blue --}}
                    <a href="{{ route('proposal.index') }}" class="card hoverable card-xl-stretch mb-xl-8"
                        style="background-color: #0C359E">
                        <div class="card-body">
                            <i class="ki-outline ki-abstract-26 text-white fs-2x ms-n1"></i>
                            <div class="text-white fw-bold fs-2 mb-2 mt-5">Total: {{ $proposal_pengajuan }}</div>
                            <div class="fw-semibold text-white">Proposal Tahap Pengajuan Internal</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    {{-- Warna Biru Keabuan - Queen Blue --}}
                    <a href="{{ route('proposal.index') }}" class="card hoverable card-xl-stretch mb-5 mb-xl-8"
                        style="background-color: #3572EF">
                        <div class="card-body">
                            <i class="ki-outline ki-abstract-28 text-white fs-2x ms-n1"></i>
                            <div class="text-white fw-bold fs-2 mb-2 mt-5">Total: {{ $proposal_pending }}</div>
                            <div class="fw-semibold text-white">Proposal Belum Diajukan </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    {{-- Warna Teal/Mint - Verdigris --}}
                    <a href="{{ route('informasi_hibah.index') }}" class="card hoverable card-xl-stretch mb-xl-8"
                        style="background-color: #40A2E3">
                        <div class="card-body">
                            <i class="ki-outline ki-pin text-white fs-2x ms-n1"></i>
                            <div class="text-white fw-bold fs-2 mb-2 mt-5">Total: {{ $hibah_aktif }}</div>
                            <div class="fw-semibold text-white">Hibah Aktif</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    {{-- Warna Biru Terang - Tuft Blue --}}
                    <a href="{{ route('proposal.index') }}" class="card hoverable card-xl-stretch mb-xl-8"
                        style="background-color: #3ABEF9">
                        <div class="card-body">
                            <i class="ki-outline ki-home text-white fs-2x ms-n1"></i>
                            <div class="text-white fw-bold fs-2 mb-2 mt-5">Internal: {{ $proposal_diterima_internal }}
                                <br>Eksternal: {{ $proposal_diterima_eksternal }}
                            </div>
                            <div class="fw-semibold text-white">Total Proposal Diterima</div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-6">
                    {{-- Warna Ungu Lembut - Wisteria --}}
                    <a href="{{ route('proposal.index') }}" class="card hoverable card-xl-stretch mb-xl-8"
                        style="background-color: #279EFF">
                        <div class="card-body">
                            <i class="ki-outline ki-send text-white fs-2x ms-n1"></i>
                            <div class="text-white fw-bold fs-2 mb-2 mt-5">Internal: {{ $proposal_ditolak_internal }}
                                <br>Eskternal: {{ $proposal_ditolak_eksternal }}
                            </div>
                            <div class="fw-semibold text-white">Total Proposal Ditolak</div>
                        </div>
                    </a>
                </div>
            </div>
            {{-- Bagian Tabel dan Grafik (Tidak diubah) --}}
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">Mitra</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Mitra Terlibat dalam Hibah</span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <table class="table align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="ps-4 rounded-start">Nama</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mitra as $item)
                                            <tr>
                                                <td class="ps-4">
                                                    {{ $item->mitra }}
                                                </td>
                                                <td>
                                                    {{ $item->jml }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">Ketua Pelaksana</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Pelaksana dalam Hibah</span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <table class="table align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="ps-4 rounded-start">Nama</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelaksana as $item)
                                            <tr>
                                                <td class="ps-4">
                                                    {{ $item->ketua_hibah }}
                                                </td>
                                                <td>
                                                    {{ $item->jml }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 mb-5 mb-xl-10 w-100">
                <div class="card card-flush h-md-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">Progres Hibah</span>
                            <span class="text-gray-500 pt-2 fw-semibold fs-6">Pelaksana</span>
                        </h3>
                    </div>
                    <div class="card-body d-flex flex-center">
                        <div id="chartProgressHibah" class="mt-5 w-100 h-350px  grafik"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    {{-- Kode JavaScript (Tidak diubah) --}}
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>


    <script>
        // Mengambil data mitra dan jml dari PHP ke dalam JavaScript
        var mitraData = @json($mitra);

        // Memformat data untuk chart
        var categories = mitraData.map(function(item) {
            return item.mitra;
        });

        var seriesData = mitraData.map(function(item) {
            return item.jml;
        });

        var initChartsWidget3 = function() {
            var element = document.getElementById("grafik_mitra");

            if (!element) {
                return;
            }

            var chart = {
                self: null,
                rendered: false
            };

            var initChart = function() {
                var height = parseInt(KTUtil.css(element, 'height'));
                var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
                var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
                var baseColor = KTUtil.getCssVariableValue('--bs-info');
                var lightColor = KTUtil.getCssVariableValue('--bs-info-light');

                var options = {
                    series: [{
                        name: 'Total',
                        data: seriesData // Menggunakan data jml yang dinamis
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: [baseColor]
                    },
                    xaxis: {
                        categories: categories, // Menggunakan data mitra yang dinamis
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        },
                        crosshairs: {
                            position: 'front',
                            stroke: {
                                color: baseColor,
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function(val) {
                                return val;
                            }
                        }
                    },
                    colors: [lightColor],
                    grid: {
                        borderColor: borderColor,
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    markers: {
                        shape: 'circle',
                        size: 5,
                        strokeColor: baseColor,
                        strokeWidth: 3,
                        hover: {
                            size: 7
                        }
                    }
                };

                chart.self = new ApexCharts(element, options);
                chart.self.render();
                chart.rendered = true;
            }

            // Init chart
            initChart();

            // Update chart on theme mode change
            KTThemeMode.on("kt.thememode.change", function() {
                if (chart.rendered) {
                    chart.self.destroy();
                }

                initChart();
            });
        }

        // Panggil fungsi untuk inisialisasi chart setelah DOM siap
        initChartsWidget3();
    </script>
    <script>
        // Mengambil data mitra dan jml dari PHP ke dalam JavaScript
        var pelaksanaData = @json($pelaksana);

        // Memformat data untuk chart
        var categories = pelaksanaData.map(function(item) {
            return item.ketua_hibah;
        });

        var seriesData = pelaksanaData.map(function(item) {
            return item.jml;
        });

        var initChartsWidget4 = function() {
            var element = document.getElementById("grafik_ketua_pelaksana");

            if (!element) {
                return;
            }

            var chart = {
                self: null,
                rendered: false
            };

            var initChart = function() {
                var height = parseInt(KTUtil.css(element, 'height'));
                var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
                var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
                var baseColor = KTUtil.getCssVariableValue('--bs-primary');
                var lightColor = KTUtil.getCssVariableValue('--bs-primary-light');

                var options = {
                    series: [{
                        name: 'Total',
                        data: seriesData // Menggunakan data jml yang dinamis
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: [baseColor]
                    },
                    xaxis: {
                        categories: categories, // Menggunakan data mitra yang dinamis
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        },
                        crosshairs: {
                            position: 'front',
                            stroke: {
                                color: baseColor,
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function(val) {
                                return val;
                            }
                        }
                    },
                    colors: [lightColor],
                    grid: {
                        borderColor: borderColor,
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    markers: {
                        shape: 'circle',
                        size: 5,
                        strokeColor: baseColor,
                        strokeWidth: 3,
                        hover: {
                            size: 7
                        }
                    }
                };

                chart.self = new ApexCharts(element, options);
                chart.self.render();
                chart.rendered = true;
            }

            // Init chart
            initChart();

            // Update chart on theme mode change
            KTThemeMode.on("kt.thememode.change", function() {
                if (chart.rendered) {
                    chart.self.destroy();
                }

                initChart();
            });
        }

        // Panggil fungsi untuk inisialisasi chart setelah DOM siap
        initChartsWidget4();
    </script>
    {{-- progres per hibah --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const options = {
                chart: {
                    type: 'bar',
                    stacked: true,
                    height: 400
                },
                title: {
                    text: 'Progress Hibah per Tahun'
                },
                xaxis: {
                    categories: @json($chartData['categories']),
                    title: {
                        text: 'Hibah'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Kegiatan'
                    }
                },
                legend: {
                    position: 'top'
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 4,
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return Number.isInteger(val) ? val : val.toFixed(0);
                        }
                    }
                },
                series: @json($chartData['series']),
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return Number.isInteger(val) ? val : val.toFixed(0);
                    }
                },
                colors: ['#FBEEAC', '#F4D160', '#75C2F6', '#1D5D9B']
            };


            const chart = new ApexCharts(document.querySelector("#chartProgressHibah"), options);
            chart.render();
        });
    </script>
@endsection
