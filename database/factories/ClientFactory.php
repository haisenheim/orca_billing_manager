<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Faker\Generator as Faker;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    //protected Faker $faker;
    protected $model = Client::class;

    public function __construct()
    {
        //$this->faker = new Faker();
    }

    public function definition()
    {
        return [
            //
            'name'=>$this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'code' =>$this->faker->random_bytes(6),
            'phone'=>$this->faker->phoneNumber(),
            'niu'=>$this->faker->random_bytes(14),
            'rccm'=>$this->faker->random_bytes(14),
            'profil_id'=>$this->faker->rand(1,5),
            'ville_id'=>$this->faker->rand(1,2),
            ];
    }
}
