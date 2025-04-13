<?php

if (!function_exists('convertStatus')) {
    function convertStatus($value)
    {
        switch ($value) {
            case 0:
                $status = [
                    'badge'   => '<span class="badge badge-pill badge-danger">Ditolak</span>',
                    'color'   => 'danger'
                ];
                break;
            case 1:
                $status = [
                    'badge'   => '<span class="badge badge-pill badge-warning">Pending</span>',
                    'color'   => 'warning'
                ];
                break;
            case 2:
                $status = [
                    'badge'   => '<span class="badge badge-pill badge-info">Pengajuan</span>',
                    'color'   => 'info'
                ];
                break;
            case 3:
                $status = [
                    'badge'   => '<span class="badge badge-pill badge-success">Diterima</span>',
                    'color'   => 'success'
                ];
                break;
            default:
                $status = [
                    'reguler' => 'Status Tidak ditemukan',
                    'badge'   => 'Status Tidak ditemukan',
                    'color'   => 'danger'
                ];
                break;
        }

        return $status;
    }
}
