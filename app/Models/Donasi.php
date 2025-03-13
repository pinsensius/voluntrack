<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donasi extends Model
{
    protected $table = "donasis";

    protected $fillable = [
        'order_id',
        'donatur',
        'event_id',
        'amount',
        'payment_type',
        'transaction_status',
    ];

    public function donatur():BelongsTo
    {
        return $this->belongsTo(User::class, 'donatur');
    }

    public function idEvent():BelongsTo
    {
        return $this->belongsTo(Event::class, "event_id");
    }
    
}
