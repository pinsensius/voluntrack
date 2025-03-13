<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Relawan extends Model
{
    protected $table = 'relawans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'user_id',
        'nama_lengkap',
        'nomor_telepon',
        'nama_organisasi',
        'nik'
    ];

    public function event():BelongsTo{
        return $this->belongsTo(Event::class);
    }
}
