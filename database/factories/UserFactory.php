<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> f9bcb00 (Creando el modelo, vista, controlador de el sistema Login de usuarios)
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
<<<<<<< HEAD
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
=======
>>>>>>> f9bcb00 (Creando el modelo, vista, controlador de el sistema Login de usuarios)
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    public function definition(): array
=======
    public function definition()
>>>>>>> f9bcb00 (Creando el modelo, vista, controlador de el sistema Login de usuarios)
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
<<<<<<< HEAD
            'password' => static::$password ??= Hash::make('password'),
=======
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
>>>>>>> f9bcb00 (Creando el modelo, vista, controlador de el sistema Login de usuarios)
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
<<<<<<< HEAD
     */
    public function unverified(): static
=======
     *
     * @return static
     */
    public function unverified()
>>>>>>> f9bcb00 (Creando el modelo, vista, controlador de el sistema Login de usuarios)
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
