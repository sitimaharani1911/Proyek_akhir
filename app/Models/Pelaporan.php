<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    protected $table = 'pelaporan';
    protected $guarded = [];
    public function list_kegiatan()
    {
        return $this->belongsTo(ListKegiatan::class);
    }
    public function review_keuangan()
    {
        return $this->hasOne(ReviewKeuangan::class, 'pelaporan_id');
    }
    public function review_piu()
    {
        return $this->hasOne(ReviewPiu::class);
    }
}
