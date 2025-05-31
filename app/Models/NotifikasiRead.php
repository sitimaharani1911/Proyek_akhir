<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiRead extends Model
{
    protected $table = 'notifikasi_read';
    protected $guarded = [];

    public function notifikasi()
    {
        return $this->belongsTo(notifikasi::class, 'notifikasi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
