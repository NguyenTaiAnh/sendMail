<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mail_senders', function (Blueprint $table) {
            $table->id();
            $table->string("id_user")->nullable();
            $table->integer("id_content")->unsigned()->nullable();
            $table->integer("id_mail")->unsigned()->nullable();
            $table->string("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_senders');
    }
};
