<?php

namespace Database\Factories;

use App\Models\MailContent;
use App\Models\MailSenders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MailSenders>
 */
class MailSendersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = MailSenders::class;
    public function definition(): array
    {
        return [
            "id_user"=> $this->faker->name,
            "id_content"=>function() {
                return MailContent::count() > 0 ? MailContent::all()->random()->id : null;
            },
            "email"=> $this->faker->email,
        ];
    }
}
