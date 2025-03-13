<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'codigo';
    public $incrementing = false;

    protected $fillable = [
        'empresa',
        'codigo',
        'razao_social',
        'tipo',
        'cpf_cnpj'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'empresa', 'codigo');
    }
}
