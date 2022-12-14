<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class BienesModel extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $table = 'bienes_model';

    protected $fillable = [
        'articulo',
        'descripcion',
        'user_id',
    ];

    public function User(){
        return $this->belongsTo(Users_Model::class);
    }
    protected $hidden = [
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
}
