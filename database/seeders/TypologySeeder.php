<?php

namespace Database\Seeders;

use App\Models\Typology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $_typologies = ['Front-end', 'Back-end', 'Full-Stack'];

        foreach ($_typologies as $_typology) {
            $typology = new Typology();
            $typology->name = $_typology;
            $typology->color = $faker->hexColor();


            $typology->save();
        }
    }
}