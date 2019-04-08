<?php

use Illuminate\Database\Seeder;

class MagazinCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('magazine_categories')->insert([
            ['name' => 'moda'],
            ['name' => 'poznati'],
            ['name' => 'zdravlje'],
            ['name' => 'nega'],
            ['name' => 'život'],
            ['name' => 'razno'],
        ]);
    }
}
