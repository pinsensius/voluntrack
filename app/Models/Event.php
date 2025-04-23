<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = "events";
    protected $primaryKey = "id_event";

    protected $fillable = [
        'event_image',
        'vr_image',
        'host',
        'tags',
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'latitude', 'longitude',
        'event_detail',
        'requirement',
        'target_donasi',
        'alamat',
        'status'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'host');
    }

    public function relawan(): HasMany{
        return $this->hasMany(Relawan::class, 'event_id');
    }

    public function donatur():HasMany{
        return $this->hasMany(Donasi::class, 'event_id');
    }

    

}
