<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
     return view('auth.login');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth', 'can:admin'], 'namespace' => 'admin', 'prefix' => 'admin'], function(){

	Route::get('setor-delete/{id}', 'SetorController@setorDelete')->name('setor.delete');
	Route::get('setor-confirm/{id}', 'SetorController@setorConfirm')->name('setor.confirm');
	Route::post('setor-update', 'SetorController@setorUpdate')->name('setor.update');
	Route::get('setor-edit/{id}', 'SetorController@setorEdit')->name('setor.edit');
	Route::any('setor-search', 'SetorController@setorSearch')->name('setor.search');
	Route::post('setor-store', 'SetorController@setorStore')->name('setor.store');
	Route::get('setor-create', 'SetorController@setorCreate')->name('setor.create');
	Route::get('setor-list', 'SetorController@setorList')->name('setor.list');


	Route::get('user-status/{id}', 'UserController@userStatus')->name('user.status');
	Route::get('user-delete/{id}', 'UserController@userDelete')->name('user.delete');
	Route::get('user-confirm/{id}', 'UserController@userConfirm')->name('user.confirm');
	Route::post('user-update', 'UserController@userUpdate')->name('user.update');
	Route::get('user-edit/{id}', 'UserController@userEdit')->name('user.edit');
	Route::any('user-search', 'UserController@userSearch')->name('user.search');
	Route::post('user-store', 'UserController@userStore')->name('user.store');
	Route::get('user-create', 'UserController@userCreate')->name('user.create');
	Route::get('user-list', 'UserController@userList')->name('user.list');
});

Route::group(['middleware' => ['auth', 'can:admin']], function(){
	Route::get('admin/password-reset/{id}', 'User\PasswordController@passwordReset')->name('password.reset');
});

Route::group(['middleware' => 'auth', 'namespace' => 'user', 'prefix' => 'user'], function(){

	Route::post('password-update', 'PasswordController@passwordUpdate')->name('password.update');
	Route::get('password-edit', 'PasswordController@passwordEdit')->name('password.edit');

	Route::get('visitante-info/{id}', 'VisitanteController@visitanteInfo')->name('visitante.info');
	Route::get('visitante-delete/{id}', 'VisitanteController@visitanteDelete')->name('visitante.delete');
	Route::get('visitante-confirm/{id}', 'VisitanteController@visitanteConfirm')->name('visitante.confirm');
	Route::post('visitante-update', 'VisitanteController@visitanteUpdate')->name('visitante.update');
	Route::get('visitante-edit/{id}', 'VisitanteController@visitanteEdit')->name('visitante.edit');
	Route::any('visitante-search', 'VisitanteController@visitanteSearch')->name('visitante.search');
	Route::post('visitante-store', 'VisitanteController@visitanteStore')->name('visitante.store');
	Route::get('visitante-create', 'VisitanteController@visitanteCreate')->name('visitante.create');
	Route::get('visitante-list', 'VisitanteController@visitanteList')->name('visitante.list');
		
	Route::any('visita-search', 'VisitaController@visitaSearch')->name('visita.search');
	Route::get('visita-info/{id}', 'VisitaController@visitaInfo')->name('visita.info');
	Route::get('visita-delete/{id}', 'VisitaController@visitaDelete')->name('visita.delete');
	Route::get('visita-confirm/{id}', 'VisitaController@visitaConfirm')->name('visita.confirm');
	Route::get('visita-update/{id}', 'VisitaController@visitaUpdate')->name('visita.update');
	Route::get('visita-saida/{id}', 'VisitaController@visitaSaida')->name('visita.saida');
	Route::post('visita-store', 'VisitaController@visitaStore')->name('visita.store');
	Route::get('visita-create/{id}', 'VisitaController@visitaCreate')->name('visita.create');
	Route::get('visita-list', 'VisitaController@visitaList')->name('visita.list');

	Route::any('relatorio-visita-visitante-search', 'RelatorioController@relatorioVisitaVisitanteSearch')->name('relatorio.visita.visitante.search');
	Route::get('relatorio-visita-visitante', 'RelatorioController@relatorioVisitaVisitante')->name('relatorio.visita.visitante');
	
	Route::any('relatorio-visita-setor', 'RelatorioController@relatorioVisitaSetorSearch')->name('relatorio.visita.setor.search');
	Route::get('relatorio-visita-setor', 'RelatorioController@relatorioVisitaSetor')->name('relatorio.visita.setor');

	Route::get('pdf-visita-setor/{inicial}/{final}', 'PDFController@pdfVisitaSetor')->name('pdf.visita.setor');

});