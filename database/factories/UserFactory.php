<?php
// ════════════════════════════════════════════════════════════════════════════
//  database/factories/UserFactory.php
// ════════════════════════════════════════════════════════════════════════════
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'              => fake('fr_FR')->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'role'              => 'client',
            'phone'             => fake('fr_FR')->phoneNumber(),
            'address'           => fake('fr_FR')->address(),
            'remember_token'    => Str::random(10),
        ];
    }
}
