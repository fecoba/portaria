@extends('adminlte::register')

@guest
    <?php  
        echo "<script> window.location.href = '/home';</script>";
    ?>
@else
    <?php  
    
	if(auth()->user()->grupo->descricao == 'Administrador'){
	        echo "<script> window.location.href = '/admin/user-create';</script>";
	}
    else{
	        echo "<script> window.location.href = '/home';</script>";
	}
    ?>
@endguest