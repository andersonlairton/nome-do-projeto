<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'decimal';
    protected $fillable = [
        'codigo', 'empresa', 'sigla', 'razao_social'
    ];

    // Se necessário, pode desabilitar timestamps se não for usar
    public $timestamps = true;
}
