<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visita;

class Visitante extends Model
{
    protected $fillable = ['nome', 'tipo_doc', 'documento', 'foto'];

    public static $tipos = [
        'C' => 'CPF',
        'R' => 'RG',
        'T' => 'CTPS'
    ];

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
