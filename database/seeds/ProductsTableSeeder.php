<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 20;

        for ($i = 0; $i < $limit; $i++) {

        	$name = $faker->sentence($nbWords = 4, $variableNbWords = true);

            DB::table('products')->insert([
                'name' 			=> $name,
                'slug' 			=> str_slug($name),
                'price' 		=> $faker->numberBetween($min = 1000, $max = 9000),
                'image' 		=> 'product.png',
                'category_id' 	=> $faker->numberBetween($min = 1, $max = 9),
                'description' 	=> $faker->text($maxNbChars = 200)
            ]);
        }
    }
}

