<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Roles
        $roles = ['manajer', 'developer', 'desainer'];

        // Generate random file
        $documentPath = 'documents/' . $this->faker->unique()->md5 . '.txt';
        $content = $this->faker->text();
        Storage::disk('public')->put($documentPath, $content);

        return [
            'name' => $this->faker->name,
            'photo' => $this->faker->imageUrl(640, 480),
            'roles' => $this->faker->randomElement($roles),
            'email' => $this->faker->unique()->safeEmail,
            'start_date' => $this->faker->date(),
            'documents' => $documentPath,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
