<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visita;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
	private $paginas = 10;

    public function relatorioVisitaVisitante()
    {    	
    	return view('user.relatoriovisitavisitante');
    }

    public function relatorioVisitaVisitanteSearch(Request $request)
    {
       	if($request['inicial'] && !$request['final']){
       		$request['final'] = date('Y-m-d', strtotime($request['inicial'])). ' 23:59:59';
       		$request['inicial'] = date('Y-m-d', strtotime($request['inicial'])). ' 00:00:01';
       	}
       	elseif($request['inicial'] && $request['final']){
       		$request['inicial'] = date('Y-m-d', strtotime($request['inicial'])). ' 00:00:01';
            $request['final'] = date('Y-m-d', strtotime($request['final'])). ' 23:59:59';
       	}

        $attr = $request->only(['inicial', 'final']);

        $visitas = Visita::where(function($query) use($request){
       		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->orderBy('entrada', 'desc')->paginate($this->paginas);

        $visit = Visita::where(function($query) use($request){
       		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->get();

        $totalVisitantes = Visita::where(function($query) use($request){
       		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->distinct()->get(['visitante_id'])->count();

        $totalVisitas = Visita::where(function($query) use($request){
       		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->count();
    	
    	// variavel para usar na soma dos visitantes e da duração de suas visitas para calculo da média
    	$dados = [
    		'visitantes' => 0,
    		'tempos' => 0,
    	];

    	//percorre a coleção de visitas, se a saída não for vazia e o tempo em minutos retornar um número adiciona ao array para ser contado

    	foreach ($visit as $visits) {
    		if($visits->saida && is_numeric($visits->tempoEmMinutos())){
    			$dados['visitantes']++;
    			$dados['tempos'] += $visits->tempoEmMinutos();
    		}
    	}

    	if($dados['visitantes'] > 0){
    		$media = (int)($dados['tempos'] / $dados['visitantes']);
    		$media = Visita::tempoEmHoras($media);
    	} else {
    		$media = 'Erro ao calcular média';
    	}

    	return view('user.relatoriovisitavisitante')->with(['visitas' => $visitas, 'totalVisitantes' => $totalVisitantes, 'totalVisitas' => $totalVisitas, 'media' => $media, 'attr' => $attr]);
    }

    public function relatorioVisitaSetor()
    {
    	return view('user.relatoriovisitasetor');
    }

    public function relatorioVisitaSetorSearch(Request $request)
    {

       	if($request['inicial'] && !$request['final']){
       		$request['final'] = date('Y-m-d', strtotime($request['inicial'])). ' 23:59:59';
       		$request['inicial'] = date('Y-m-d', strtotime($request['inicial'])). ' 00:00:01';
       	}
       	elseif($request['inicial'] && $request['final']){
       		$request['inicial'] = date('Y-m-d', strtotime($request['inicial'])). ' 00:00:01';
            $request['final'] = date('Y-m-d', strtotime($request['final'])). ' 23:59:59';
       	}

        $attr = $request->only(['inicial', 'final']);

        $totalVisitantes = Visita::where(function($query) use($request){
       		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->distinct()->get(['visitante_id'])->count();

        $totalVisitas = Visita::where(function($query) use($request){
       		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->count();

        $visitas = Visita::where(function($query) use($request){
          $query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->select(DB::raw('visitas.setor_id, setors.nome, COUNT(*) as total'))->join('setors', 'visitas.setor_id', '=', 'setors.id')->groupBy('visitas.setor_id')->orderBy('setors.nome')->paginate($this->paginas);

    	return view('user.relatoriovisitasetor')->with(['visitas' => $visitas, 'totalVisitantes' => $totalVisitantes, 'totalVisitas' => $totalVisitas, 'attr' => $attr]);
    }
}
