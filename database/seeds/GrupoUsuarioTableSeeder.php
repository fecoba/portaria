<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoUsuario;

class GrupoUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GrupoUsuario::create([
        	'descricao'	=>	'Administrador',
        ]);
        GrupoUsuario::create([
        	'descricao'	=>	'Porteiro',
        ]);

    }
}
