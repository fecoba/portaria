<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visitante;
use App\Models\Visita;
use App\Http\Requests\VisitanteValidationFormRequest;
use Illuminate\Support\Facades\Storage;

class VisitanteController extends Controller
{
	private $paginas = 10;

	private function setNomeArquivo()
	{
		//gera um nome aleatório com 27 caracteres para o arquivo de foto.
		return uniqid(date('HisYmd'));
	}

	private function delFoto(Visitante $visitante)
	{
		//apaga foto do visitante na pasta se existir
  		if($visitante->foto)
   			Storage::delete("visitantes/{$visitante->foto}");
	}

    public function visitanteList()
    {
    	$visitantes = Visitante::orderBy('nome')->paginate($this->paginas);
    	return view('user.visitantelist')->with('visitantes', $visitantes);
    }

    public function visitanteCreate()
    {
    	return view('user.visitantecreate')->with('tipos', Visitante::$tipos);
    }

    public function visitanteStore(VisitanteValidationFormRequest $request)
    {
    	// $request['foto'] refere-se ao nome do arquivo que deverá ser gravado no banco de dados
    	if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
    		$request['foto'] = $this->setNomeArquivo().'.'.$request->file('imagem')->extension();
    		$upload = $request->file('imagem')->storeAs('visitantes', $request['foto']);

    		if(!$upload)
    			return redirect()
    				->back()
    				->with('error', 'Ocorreu um erro ao tentar fazer upload da foto.');
    	}
    	if(Visitante::create($request->all()))
    		return redirect()
    			->back()
    			->with('success', 'Operação realizada com sucesso.');

    	return redirect()
    		->back()
    		->with('error', 'Falha ao executar operação.');
    }

    public function visitanteSearch(Request $request)
    {
        $attr = $request->only(['nome', 'documento']);
        $visitantes = Visitante::where(function($query) use($attr){
            foreach ($attr as $key => $value) {
                if($value)
                    $query->orwhere($key, 'LIKE', "%$value%");
            }
         })->paginate($this->paginas);
        // })->toSql();
        return view('user.visitantelist')->with(['visitantes'=>$visitantes, 'attr'=>$attr]);    	
    }

    public function visitanteEdit($id)
    {
    	$visitante = Visitante::find($id);
        if(!$visitante)
            return redirect()->back();
    	return view('user.visitanteedit')->with(['visitante'=> $visitante, 'tipos' => Visitante::$tipos]);
    }

    public function visitanteUpdate(VisitanteValidationFormRequest $request)
    {
    	$visitante = Visitante::find($request['id']);

    	if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
    		$request['foto'] = $this->setNomeArquivo().'.'.$request->file('imagem')->extension();
    		$upload = $request->file('imagem')->storeAs('visitantes', $request['foto']);

    		if(!$upload)
    			return redirect()
    				->back()
    				->with('error', 'Ocorreu um erro ao tentar fazer upload da foto.');

    		//verifica se já havia foto cadastrada e a exclui
    		$this->delFoto($visitante);

    	}
    	if($visitante->update($request->all()))
    		return redirect()
    			->route('visitante.list')
    			->with('success', 'Operação realizada com sucesso.');

    	return redirect()
    		->back()
    		->with('error', 'Falha ao executar operação.');

    }

    public function visitanteConfirm($id)
    {
    	$visitante = Visitante::find($id);
    	if(!$visitante)
    		return redirect()->back();
    	
    	return view('user.visitanteconfirm')->with('visitante', $visitante);
    }

    public function visitanteDelete($id)
    {
    	$visitante = Visitante::find($id);
    	if(!$visitante)
    		return redirect()->back();

        if($visitante->visitas->isEmpty()){
   		   $this->delFoto($visitante);
            if ($visitante->delete()){
                return redirect(route('visitante.list'))
                    ->with('success', 'Operação realizada com sucesso.');
            }
            return redirect(route('visitante.list'))
                ->with('error', 'Falha ao executar operação.');
        }else{
            return redirect()->route('visitante.list')->with('error', 'Apenas visitantes sem visita(s) cadastrada(s) podem ser excluídos');
        }
    }

    public function visitanteInfo($id)
    {
        $visitante = Visitante::find($id);
        if(!$visitante)
            return redirect()->back();
        $visitas = Visita::where('visitante_id', $id)->orderBy('entrada', 'desc')->paginate($this->paginas);

        return view('user.visitanteinfo')->with(['visitante' => $visitante, 'visitas' => $visitas]);
    }


}
