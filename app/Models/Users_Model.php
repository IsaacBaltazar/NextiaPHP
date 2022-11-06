<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Users_Model extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $table = 'users_model';

    protected $fillable = [
        'nombre',
        'usuario',
        'password',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function Users()
    {
        return $this->hasMany('App\Models\BienesModel', 'usario_id', 'id');
    }
}
