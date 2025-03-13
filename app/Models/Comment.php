<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $table = "comments";

    protected $fillable = [
        'id_topic',
        'id_commenter',
        'comment',
        'tanggal_dibuat'
    ];

    public function author():BelongsTo{
        return $this->belongsTo(User::class, "id_commenter");
    }

    public function topic():BelongsTo{
        return $this->belongsTo(Topic::class, "id_topic", 'id');
    }
}
