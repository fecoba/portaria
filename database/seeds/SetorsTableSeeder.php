<?php

use Illuminate\Database\Seeder;
use App\Models\Setor;

class SetorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setor::create([
        	'nome' => 'Protocolo',
        	'telefone' => '31555050',
        ]);

        Setor::create([
        	'nome' => 'Xerox',
        	'telefone' => '31551010',
        ]);
        
        Setor::create([
        	'nome' => 'Administrativo',
        	'telefone' => '31552210',
        ]);

        Setor::create([
        	'nome' => 'Almoxarifado',
        	'telefone' => '31551950',
        ]);
        
        Setor::create([
        	'nome' => 'Departamento Pessoal',
        	'telefone' => '31550240',
        ]);
        
        Setor::create([
        	'nome' => 'Sala do Servidor',
        	'telefone' => '31556060',
        ]);
        
        Setor::create([
        	'nome' => 'Controladoria Geral',
        	'telefone' => '31554044',
        ]);
        
        Setor::create([
        	'nome' => 'Controle de Patrimônio',
        	'telefone' => '31559090',
        ]);
        
        Setor::create([
        	'nome' => 'Contabilidade',
        	'telefone' => '31553350',
        ]);
        
        Setor::create([
        	'nome' => 'Recepção',
        	'telefone' => '31550101',
        ]);
        
        Setor::create([
        	'nome' => 'Gabinete',
        	'telefone' => '31557070',
        ]);
        
        Setor::create([
        	'nome' => 'Contratos e Convênios',
        	'telefone' => '31551088',
        ]);
        
        Setor::create([
        	'nome' => 'Habitação',
        	'telefone' => '31556010',
        ]);
        
        Setor::create([
        	'nome' => 'Estacionamento',
        	'telefone' => '31550101',
        ]);    

    }
}
