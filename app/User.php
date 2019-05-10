<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\GrupoUsuario;
use App\Models\Visita;

class User extends Authenticatable
{
    use Notifiable;
    public static $tipos = [
        'C' => 'CPF',
        'R' => 'RG',
        'T' => 'CTPS'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tipo_doc', 'documento', 'grupo_usuarios_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function grupo()
    {
        return $this->belongsTo(GrupoUsuario::class, 'grupo_usuarios_id');
    }

    public function descDoc()
    {
        return self::$tipos[$this->tipo_doc];
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }

    private function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
            if($mask[$i] == '#'){
                if(isset($val[$k])){
                    $maskared .= $val[$k++];
                }
            }
            else{
                if(isset($mask[$i])){
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }

    public function formatedDoc()
    {
        if($this->tipo_doc == 'C')
            return $this->mask($this->documento, '###.###.###-##');
        return $this->documento;
    }    
    
}
