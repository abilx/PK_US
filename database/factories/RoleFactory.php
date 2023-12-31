<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'id' => 1,
            'name' => 'admin',
            'insert_date' => '2023-02-08 20:10:46',
            'remark' => 'Administrator',
            'redirectTo' => 'Admin',
            // Add other attributes as needed
        ];
    }
}

