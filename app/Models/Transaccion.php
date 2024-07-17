<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transacciones';

    protected $fillable = [
        'banco_id',
        'tipo',
        'monto',
        'descripcion',
        'created_at',
    ];

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }
}
