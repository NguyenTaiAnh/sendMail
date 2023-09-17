<?php

namespace Database\Seeders;

use App\Models\MailContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MailContent::factory()->count(50)->create();
    }
}
