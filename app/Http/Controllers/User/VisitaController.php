<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\VisitaValidationFormRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Setor;

class VisitaController extends Controller
{
	private $paginas = 10;

    public function visitaCreate($id)
    {
    	$visitante = Visitante::find($id);
    	if(!$visitante)
    		return redirect()->back();
    	$setors = Setor::orderBy('nome')->get();
    	return view('user.visitacreate')->with(['visitante' => $visitante, 'user' => auth()->user()->id, 'setors' => $setors ]);
    }

    public function visitaStore(VisitaValidationFormRequest $request)
    {
    	$request['entrada'] = date('Y-m-d H:i:s');
    	$request['user_id'] = auth()->user()->id;
    	$request['pessoa'] = $request['pessoa'] ? $request['pessoa'] : 'Qualquer pessoa';
    	$request['assunto'] = $request['assunto'] ? $request['assunto'] : 'Particular';

    	if(Visita::create($request->only(['visitante_id', 'user_id', 'entrada', 'cracha', 'setor_id', 'pessoa', 'assunto'])))
    		return redirect()
    			->route('visitante.list')
    			->with('success', 'Operação realizada com sucesso.');

    	return redirect()
    		->back()
    		->with('error', 'Falha ao executar operação.');    		
    }

    public function visitaList()
    {
    	$visitas = Visita::orderBy('entrada', 'desc')->paginate($this->paginas);
    	return view('user.visitalist')->with('visitas', $visitas);
    }

    public function visitaSaida($id)
    {
    	$visita = Visita::find($id);
    	if(!$visita)
    		return redirect()->back();

    	return view('user.visitasaida')->with('visita', $visita);

    }

    public function visitaUpdate($id)
    {
    	$visita = Visita::find($id);
    	if(!$visita)
    		redirect()->back();

    	$visita->saida = date('Y-m-d H:i:s');
    	if($visita->save())
    		return redirect()
    			->route('visita.list')
    			->with('success', 'Operação realizada com sucesso.');

    	return redirect()
    		->back()
    		->with('error', 'Falha ao executar operação.');

    }

    public function visitaConfirm($id)
    {
    	$visita = Visita::find($id);
        if(!$visita)
            return redirect()->back();
    	return view('user.visitaconfirm')->with('visita', $visita);

    }

    public function visitaDelete($id)
    {
    	$visita = Visita::find($id);
    	if(!$visita)
    		return redirect()->back();

        if(($visita->user_id == auth()->user()->id) || (auth()->user()->grupo->descricao == 'Administrador')){
            if ($visita->delete())
                return redirect(route('visita.list'))
                    ->with('success', 'Operação realizada com sucesso.');

            return redirect(route('visitante.list'))
                ->with('error', 'Falha ao executar operação.');
        }else{
            return redirect()->back()
                ->with('error', 'O usuário não tem autorização para excluir essa visita.');
        }
    }

    public function visitaSearch(Request $request)
    {     
        $visitas = Visita::where(function($query) use($request){
        	if($request['inicial'] && !$request['final']){
        		$request['final'] = date('Y-m-d', strtotime($request['inicial'])). ' 23:59:59';
        		$request['inicial'] = date('Y-m-d', strtotime($request['inicial'])). ' 00:00:01';
        		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
        	}
        	elseif($request['inicial'] && $request['final']){
        		$request['inicial'] = date('Y-m-d', strtotime($request['inicial'])). ' 00:00:01';
                $request['final'] = date('Y-m-d', strtotime($request['final'])). ' 23:59:59';
        		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
        	}
         })->orderBy('entrada', 'desc')->paginate($this->paginas);
        // })->toSql();
        // dd($visitas);
        $attr = $request->only(['inicial', 'final']);
        return view('user.visitalist')->with(['visitas'=>$visitas, 'attr'=>$attr]);
    }

    public function visitaInfo($id)
    {
    	$visita = Visita::find($id);
    	if(!$visita)
    		return	redirect()->back();
    	
    	return view('user.visitainfo')->with('visita', $visita);
    }

}
