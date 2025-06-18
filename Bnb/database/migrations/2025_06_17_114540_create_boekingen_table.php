<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boekings', function (Blueprint $table) {
            $table->id();
            $table->date('checkin');
            $table->date('checkout');
            $table->integer('volwassenen');
            $table->integer('kinderen')->default(0);
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('email');
            $table->string('telefoon');
            $table->text('vragen')->nullable();
            $table->timestamps(); // Maakt 'created_at' en 'updated_at' aan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boekingen');
    }
};
