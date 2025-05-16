<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenHibah extends Model
{
    protected $table = 'dokumen_hibah';
    public function informasi_hibah()
    {
        return $this->belongsTo(InformasiHibah::class, 'informasi_hibah_id', 'id');
    }
}
