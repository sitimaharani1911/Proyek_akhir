<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewKeuangan extends Model
{
    protected $table = 'review_keuangan';
    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class);
    }
}
