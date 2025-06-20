<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('boekings', function (Blueprint $table) {
        $table->id();
        $table->date('checkin');
        $table->date('checkout');
        $table->unsignedTinyInteger('volwassenen');
        $table->unsignedTinyInteger('kinderen')->nullable();
        $table->string('voornaam');
        $table->string('achternaam');
        $table->string('email');
        $table->string('telefoon');
        $table->text('vragen')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
