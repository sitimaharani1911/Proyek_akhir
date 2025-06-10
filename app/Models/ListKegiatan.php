<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListKegiatan extends Model
{
    protected $table = 'list_kegiatan';
    protected $guarded = [];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
    // ListKegiatan.php
    public function pelaporan()
    {
        return $this->hasMany(Pelaporan::class);
    }
}
