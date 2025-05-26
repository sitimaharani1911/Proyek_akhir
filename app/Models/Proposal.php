<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposal';
    protected $guarded = [];

    public function informasi_hibah()
    {
        return $this->belongsTo(InformasiHibah::class, 'informasi_hibah_id', 'id');
    }
    public function listKegiatan()
{
    return $this->hasMany(ListKegiatan::class);
}

}
