<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'alamat',
        'no_hp',
        'profile',
        'nik',
        'ktp',
        'role',
        'verificaton-code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function events():HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function topic():HasMany{
        return $this->hasMany(Topic::class);
    }

    public function comment():HasMany{
        return $this->hasMany(Comment::class);
    }

    public function donatur():HasMany{
        return $this->hasMany(Donasi::class, 'donatur');
    }

    public function isHost()
    {
        return $this->role === 'host'; 
    }
}
