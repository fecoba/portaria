<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Visitante;
use App\Models\Setor;
use Carbon\Carbon;


class Visita extends Model
{
	protected $fillable = ['visitante_id', 'user_id', 'cracha', 'entrada', 'saida', 'setor_id', 'pessoa', 'assunto'];
    
    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function visitante()
    {
    	return $this->belongsTo(Visitante::class, 'visitante_id');
    }

    public function setor()
    {
    	return $this->belongsTo(Setor::class);
    }

    public function tempoEmMinutos()
    /* essa função tem o objetivo de verificar se a entrada e a saida foram dadas no mesmo dia para poder calcular a média de minutos das visitas apenas nos registros que tiveram entrada e saída no mesmo dia*/
    {
        if($this->saida){
            // converte o formato da data da DB para o formato 'Y-m-d' para criar o objeto Carbon nesse formato
            $entrada = date('Y-m-d', strtotime($this->entrada));
            $saida = date('Y-m-d', strtotime($this->saida));

            $entrada = Carbon::createFromFormat('Y-m-d', $entrada);
            $saida = Carbon::createFromFormat('Y-m-d', $saida);
            if($saida->diffInDays($entrada) < 1){
                //se a diferença entre entrada e saída for menor que 1 calcula o intervalo de minutos entre a entrada e saída
                $entrada = Carbon::createFromFormat('Y-m-d H:i:s', $this->entrada);
                $saida = Carbon::createFromFormat('Y-m-d H:i:s', $this->saida);                
                return $saida->diffInMinutes($this->entrada);
            }else{
                // se a diferença em dias entre data de entrada e saída for maior que zero retorna uma string(para retornar false no foreach da view)
                return 'Data de saída diferente da data de entrada';
            }
        }
                // se a visita ainda não estiver fechada, ou seja, não tiver data-hora de saída retorna uma string(para retornar false no foreach da view)        
        return 'Visita em aberto';
    }

    public static function tempoEmHoras($minutos)
    {
//        $minutos = $this->tempoEmMinutos();
        if(is_numeric($minutos)){
            if($minutos > 59){
                $horas = (int)($minutos / 60);
                $minutos = $minutos % 60;
            }
            return isset($horas) ? $horas.'h '.$minutos.'min' : $minutos.'min';
        }
        return $minutos;
    }

}
