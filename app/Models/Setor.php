<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visita;

class Setor extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'telefone'];

    public function visitas()
    {
    	return $this->hasMany(Visita::class);
    }
}
