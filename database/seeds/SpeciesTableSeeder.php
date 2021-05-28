<?php

use Illuminate\Database\Seeder;
use App\Specie;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $species = [
            ['name' => 'DINHEIRO'],
            ['name' => 'CHEQUE'],
            ['name' => 'CRÉDITO'],
            ['name' => 'DÉBITO'],
            ['name' => 'BOLETO'],
            ['name' => 'TRANSFERÊNCIA']
        ];

        foreach ($species as $specie) {
            Specie::create($specie);
        }
        
    }
}
