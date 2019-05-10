<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetorValidationFormRequest;
use App\Models\Setor;

class SetorController extends Controller
{
    private $paginas = 10;

    public function setorCreate()
    {
    	return view('admin.setorcreate');
    }

    public function setorStore(SetorValidationFormRequest $request)
    {
    	if(Setor::create($request->all()))
    		return redirect()
    			->back()
    			->with('success', 'Operação realizada com sucesso.');

    	return redirect()
    		->back()
    		->with('error', 'Falha ao executar operação.');
    }

    public function setorList()
    {
        $setors = Setor::orderBy('nome')->paginate($this->paginas);
        return view('admin.setorlist')->with('setors', $setors);
    }

    public function setorSearch(Request $request)
    {
        $attr = $request->only(['nome', 'telefone']);
        $setors = Setor::where(function($query) use($attr){
            foreach ($attr as $key => $value) {
                if($value)
                    $query->orwhere($key, 'LIKE', "%$value%");
            }
        })->paginate($this->paginas);
        return view('admin.setorlist')->with(['setors'=>$setors, 'attr'=>$attr]);
    }

    public function setorEdit($id)
    {
        $setor = Setor::find($id);
        return view('admin.setoredit')->with('setor', $setor);
    }

    public function setorUpdate(SetorValidationFormRequest $request)
    {
        $setor = Setor::find($request['id']);
        if ($setor->update($request->all()))
            return redirect()
                ->back()
                ->with('success', 'Operação realizada com sucesso.');

        return redirect()
            ->back()
            ->with('error', 'Falha ao executar operação.');
    }

    public function setorConfirm($id)
    {
        $setor = Setor::find($id);
        if(!$setor)
            return redirect()->back();

        return view('admin.setorconfirm')->with('setor', $setor);

    }
    
    public function setorDelete($id)
    {
        $setor = Setor::find($id);
        if(!$setor)
            return redirect()->back();

        if($setor->visitas->isEmpty()){
            if ($setor->delete()){
                return redirect(route('setor.list'))
                    ->with('success', 'Operação realizada com sucesso.');
            }else{
                return redirect(route('setor.list'))
                    ->with('error', 'Falha ao executar operação.');
            }
        }
        else{
            return redirect()->route('setor.list')->with('error', 'Apenas setores ainda não visitados podem ser excluídos');
        }

    }
    

}
