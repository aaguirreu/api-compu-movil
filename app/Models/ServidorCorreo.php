<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServidorCorreo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servidor_correo';

    protected $fillable = [
        'protocol',
        'host',
        'port',
        'encryption',
    ];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
