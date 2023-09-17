<?php

namespace Database\Seeders;

use App\Models\MailSenders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailSendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MailSenders::factory()->count(50)->create();
    }
}
