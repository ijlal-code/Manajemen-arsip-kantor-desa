<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function arsip()
    {
        return $this->hasMany(Arsip::class);
    }

    public function aksesArsips() {
        return $this->belongsToMany(Arsip::class, 'arsip_user');
    }

    public function profil()
{
    return $this->hasOne(Profil::class);
}

}
