<?php

namespace App\Http\Controllers;

use Faker\Factory;

class FakerController extends Controller {
    private $faker;

    public function __construct() {
        $this->faker = Factory::create('pt_BR');
    }

    public function usuario() {
        $gender   = 'male';
        $faker    = $this->faker;
        $resposta = [
            'title'           => $faker->title($gender), // 'Ms.'
            'titleMale'       => $faker->titleMale(), // 'Mr.'
            'titleFemale'     => $faker->titleFemale(), // 'Ms.'
            'suffix'          => $faker->suffix(), // 'Jr.'
            'name'            => $faker->name($gender), // 'Dr. Zane Stroman'
            'firstName'       => $faker->firstName($gender), // 'Maynard'
            'firstNameMale'   => $faker->firstNameMale(), // 'Maynard'
            'firstNameFemale' => $faker->firstNameFemale(), // 'Rachel'
            'lastName'        => $faker->lastName(), // 'Zulauf'
            'realText'        => $faker->realText($maxNbChars = 200, $indexSize = 2),
            'realTextBetween' => $faker->realTextBetween($minNbChars = 160, $maxNbChars = 200, $indexSize = 2),
        ];

        return $resposta;
    }
}
