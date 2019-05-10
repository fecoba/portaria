<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' 				=>	'Fernando Costa Batista',
    		'tipo_doc' 			=>	'C',
    		'documento'			=>	'338.776.628-97',
    		'grupo_usuarios_id'	=>	1,
    		'email'				=>	'nandocbatista@gmail.com',
    		'password'			=>	bcrypt('123456'),
    	]);        
        User::create([
            'name'              =>  'Marcela Santos de Souza',
            'tipo_doc'          =>  'C',
            'documento'         =>  '820.910.512-41',
            'grupo_usuarios_id' =>  2,
            'email'             =>  'marcelasdes@gmail.com',
            'password'          =>  bcrypt('123456'),
        ]);        
        User::create([
            'name'              =>  'Luan Ferrari Machado',
            'tipo_doc'          =>  'R',
            'documento'         =>  '123456789098765',
            'grupo_usuarios_id' =>  2,
            'email'             =>  'luanferrari@gmail.com',
            'password'          =>  bcrypt('123456'),
        ]);       
        User::create([
            'name'              =>  'Poliana Brito Barbosa',
            'tipo_doc'          =>  'T',
            'documento'         =>  '987654321012345',
            'grupo_usuarios_id' =>  1,
            'email'             =>  'polibb@gmail.com',
            'password'          =>  bcrypt('123456'),
        ]);
        
    }
}
