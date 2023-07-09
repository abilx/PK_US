<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgamaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_agama' => 1, 
            'agama' => 'Islam',
            
        ];
    }
}
