<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiHibah extends Model
{
    protected $table = 'informasi_hibah';
    protected $guarded = [];

    // InformasiHibah.php
    public function proposal()
    {
        return $this->hasMany(Proposal::class);
    }

    // Proposal.php
    public function listKegiatan()
    {
        return $this->hasMany(ListKegiatan::class);
    }

    

    // Pelaporan.php
    public function monev()
    {
        return $this->hasMany(Monev::class);
    }
}
