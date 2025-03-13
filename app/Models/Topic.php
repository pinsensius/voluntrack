<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Topic extends Model
{
    protected $table = "topics";

    protected $fillable = [
        'author_id',
        'judul_topic',
        'isi_topic',
        'topic_img',
        'tanggal_dibuat'
    ];

    public function author():BelongsTo{
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments():HasMany{
        return $this->hasMany(Comment::class, 'id_topic', 'id');
    }
}
