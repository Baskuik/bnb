<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('boekings', function (Blueprint $table) {
        $table->decimal('bedrag', 8, 2)->nullable()->after('kinderen');
    });
}

public function down()
{
    Schema::table('boekings', function (Blueprint $table) {
        $table->dropColumn('bedrag');
    });
}
};
