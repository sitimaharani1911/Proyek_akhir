<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monev extends Model
{
    protected $table = 'monev';
    protected $guarded = [];

    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class);
    }
}
