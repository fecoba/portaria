<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordValidationFormRequest;
use App\User;

class PasswordController extends Controller
{
    public function passwordEdit()
    {
    	return view('user.passwordedit');
    }

    public function passwordUpdate(PasswordValidationFormRequest $request)
    {
    	if(!(Hash::check($request['passwordatual'], auth()->user()->password)))
    		return redirect()
    			->back()
    			->with('error', 'Senha atual inválida');
    	$request['password'] = bcrypt($request['password']);
    	if(auth()->user()->update($request->only('password')))
    		return redirect()
    			->back()
    			->with('success', 'Operação realizada com sucesso.');

    	return redirect()
    		->back()
    		->with('error', 'Falha ao executar operação.');    		
    }

    public function passwordReset($id)
    {
    	$user = User::find($id);
        if(!$user)
            return redirect()->back();
    	$user->password = bcrypt('123456');
    	if($user->save())
    		return redirect()
    			->back()
    			->with('success', 'Operação realizada com sucesso.');

    	return redirect()
    		->back()
    		->with('error', 'Falha ao executar operação.');
    }
}
