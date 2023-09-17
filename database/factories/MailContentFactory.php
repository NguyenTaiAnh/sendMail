<?php

namespace Database\Factories;

use App\Models\MailContent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MailContent>
 */
class MailContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = MailContent::class;
    public function definition(): array
    {
        return [
            "content" => $this->faker->text,
        ];
    }
}
