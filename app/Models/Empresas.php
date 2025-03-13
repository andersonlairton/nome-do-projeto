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

    public $timestamps = true;

    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'empresa', 'codigo');
    }
}
