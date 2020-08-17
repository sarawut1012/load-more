<?php

use Illuminate\Database\Seeder;
// Import DB and Faker services
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,50) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'auther_name' =>  $faker->name,
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'image' => $faker->image('public/storage/images',1500,700, null, false),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
