<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewPIU extends Model
{
    protected $table = 'review_piu';
    protected $guarded = [];

    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class, 'pelaporan_id', 'id');
    }
}
