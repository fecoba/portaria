<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;

class HomeController extends Controller
{
    private $paginas = 8;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->status == '2'){
            auth()->logout();
            return redirect()->route('login')->with('error', 'Usuário inativo, entre em contato com um administrador do sistema.');
        }
        $visitas = Visita::whereNull('saida')->orderBy('entrada', 'desc')->paginate($this->paginas);
        if($visitas->isEmpty()){
            return view('home');
        }
        return view('user.visitahome')->with('visitas', $visitas);
    }
}
