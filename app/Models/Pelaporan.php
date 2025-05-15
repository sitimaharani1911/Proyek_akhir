<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    protected $table = 'pelaporan';
    public function list_kegiatan()
    {
        return $this->belongsTo(ListKegiatan::class);
    }
}
