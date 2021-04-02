<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $code_cne = $this->faker->numerify("R########");
        return [
            'nom' => $this->faker->lastName($gender),
            'prenom' => $this->faker->firstName($gender),
            'email' => "$code_cne@estschool.ma",
            'code_cne' => $code_cne,
            'code_cin' => $this->faker->bothify("??####"),
            'gender' => $gender,
            'filier' => $this->faker->randomElement(["GI", "GA", "TM"]),
            'annee' => $this->faker->randomElement([1, 2]),
            'lieu_naissance' => $this->faker->city,
            'date_naissance' => $this->faker->date('Y-m-d'),
        ];
    }
}
