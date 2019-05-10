<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class GrupoUsuario extends Model
{
	public $timestamps = false;
    
    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
