<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 1; $i < $limit; $i++) {

        	$name = 'Category '.$i;

            DB::table('categories')->insert([
                'name' 			=> $name,
                'slug' 			=> str_slug($name),
                'created_at' 	=> now(),
                'updated_at' 	=> now()
            ]);
        }
    }
}
