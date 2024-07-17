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
        Schema::create('servidor_correo', function (Blueprint $table) {
            $table->id();
            $table->string('protocol');
            $table->string('host');
            $table->integer('port');
            $table->string('encryption');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidor_correo');
    }
};
