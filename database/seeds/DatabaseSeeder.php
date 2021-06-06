<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(CustomersTableSeeder::class);
        //$this->call(EmployeesTableSeeder::class);
        //$this->call(SuppliersTableSeeder::class);
        //$this->call(ReceiptsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SpeciesTableSeeder::class);
    }
}
