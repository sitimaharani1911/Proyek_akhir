<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    protected $table = 'rab';
    protected $guarded = [];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id')->withDefault();
    }
}
