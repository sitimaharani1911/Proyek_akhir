<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListKegiatan extends Model
{
    protected $table = 'list_kegiatan';

    protected $fillable = [
        'proposal_id',
        'jenis_hibah',
        'program_studi',
        'jenis_aktivitas',
        'nama_kegiatan',
        'jumlah_luaran',
        'satuan_luaran',
        'luaran_kegiatan',
        'status_pelaksanaan_kegiatan',
        'total_pengajuan_anggaran',
        'total_penggunaan_anggaran',
        'tanggal_awal',
        'tanggal_akhir',
        'rentang_pengerjaan',
        'panitia_pengerjaan',
        'rincian_jumlah_peserta',
        'tempat_pelaksanaan',
        'surat_kerja',
        'surat_tugas',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
