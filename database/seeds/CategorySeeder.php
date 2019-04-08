<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Odeća'],
            ['name' => 'Obuća'],
            ['name' => 'Aksesoar'],
            ['name' => 'Dečija odeća'],
            ['name' => 'Sportska oprema'],
            ['name' => 'Plus size'],
            ['name' => 'Odeća za pse'],
            ['name' => 'Ostalo'],
        ]);
    }
}
