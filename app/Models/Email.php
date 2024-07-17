<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'servidor_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function servidorCorreo()
    {
        return $this->belongsTo(ServidorCorreo::class);
    }

    public function cuentas()
    {
        return $this->hasMany(Cuenta::class);
    }
}
