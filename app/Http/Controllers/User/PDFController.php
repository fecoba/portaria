<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visita;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function pdfVisitaSetor($inicial, $final)
    {
    	$request['inicial'] = $inicial;
    	$request['final'] = $final;

        $totalVisitantes = Visita::where(function($query) use($request){
       		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->distinct()->get(['visitante_id'])->count();

        $totalVisitas = Visita::where(function($query) use($request){
       		$query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->count();

        $visitas = Visita::where(function($query) use($request){
          $query->whereBetween('entrada', [$request['inicial'], $request['final']]);
         })->select(DB::raw('visitas.setor_id, setors.nome, COUNT(*) as total'))->join('setors', 'visitas.setor_id', '=', 'setors.id')->groupBy('visitas.setor_id')->orderBy('setors.nome')->get();

        return \PDF::loadView('user.pdfvisitasetor', compact(['visitas', 'inicial', 'final', 'totalVisitas', 'totalVisitantes']))
                ->stream('visitas-setor.pdf');
    }
}
