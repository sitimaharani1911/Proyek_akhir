<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewPimpinan extends Model
{
    protected $table = 'review_pimpinan';
    protected $guarded = [];
    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class);
    }
}
