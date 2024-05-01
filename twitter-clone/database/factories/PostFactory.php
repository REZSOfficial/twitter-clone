<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define the image routes as a static property so it can retain its state across invocations
        static $imgRoutes = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg'];

        // Check if all routes have been used, reset the array if needed
        if (empty($imgRoutes)) {
            $imgRoutes = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg'];
        }

        // Randomly select an image route and remove it from the array
        $selectedImg = fake()->randomElement($imgRoutes);
        $key = array_search($selectedImg, $imgRoutes);
        if ($key !== false) {
            unset($imgRoutes[$key]);
        }

        return [
            'user_id' => User::factory(),
            'text' => fake()->sentence(10),
            'img' => $selectedImg
        ];
    }
}
