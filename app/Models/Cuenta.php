<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_id',
        'banco_id',
        'balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
