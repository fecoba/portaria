<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\GrupoUsuario;
use App\Http\Requests\UserValidationFormRequest;

class UserController extends Controller
{
	private $paginas = 10;

    public function userList()
    {
    	$users = User::orderBy('name')->paginate($this->paginas);
    	return view('admin.userlist')->with('users', $users);
    }

    public function userSearch(Request $request)
    {
        $attr = $request->only(['name', 'email', 'documento']);
        $users = User::where(function($query) use($attr){
            foreach ($attr as $key => $value) {
                if($value)
                    $query->orwhere($key, 'LIKE', "%$value%");
            }
         })->paginate($this->paginas);
        // })->toSql();
        return view('admin.userlist')->with(['users'=>$users, 'attr'=>$attr]);
    }

    public function userCreate()
    {
    	$grupos = GrupoUsuario::all();
    	return view('admin.usercreate')->with(['grupos'=> $grupos, 'tipos'=> User::$tipos]);
    }

    public function userStore(UserValidationFormRequest $request)
    {
    	$dataForm = $request->all();
    	$dataForm['password'] = bcrypt($dataForm['password']);
    	if(User::create($dataForm))
    		return redirect()
    			->back()
    			->with('success', 'Operação realizada com sucesso.');

    	return redirect()
    		->back()
    		->with('error', 'Falha ao executar operação.');
    }

    public function userEdit($id)
    {
    	$user = User::find($id);
        if(!$user)
            return redirect()->back();
    	$grupos = GrupoUsuario::all();
    	return view('admin.useredit')->with(['user'=> $user, 'grupos'=> $grupos, 'tipos'=> User::$tipos]);
    }

    public function userUpdate(UserValidationFormRequest $request)
    {
    	$user = User::find($request['id']);

        if ($user->update($request->all()))
            return redirect()
                ->back()
                ->with('success', 'Operação realizada com sucesso.');

        return redirect()
            ->back()
            ->with('error', 'Falha ao executar operação.');

    }

    // public function userConfirm($id)
    // {
    // 	$user = User::find($id);

    // 	return view('admin.userconfirm')->with('user', $user);
    // }

    // public function userDelete($id)
    // {
    // 	$user = User::find($id);
    //     if ($user->delete())
    //         return redirect(route('user.list'))
    //             ->with('success', 'Operação realizada com sucesso.');

    //     return redirect(route('user.list'))
    //         ->with('error', 'Falha ao executar operação.');
    // }

    public function userStatus($id)
    {
        $user = User::find($id);
        if((!$user) || (($user->id) == (auth()->user()->id)))
            return redirect()->back();

        $user->status = $user->status == '1' ? '2' : '1';

        $user->save();
        return redirect()
            ->back();
    }
}
