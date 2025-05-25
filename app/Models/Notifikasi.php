<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $guarded = [];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id');
    }
}
