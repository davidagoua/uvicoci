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
        Schema::create('copie_integrales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('owner')->default(false);
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('type_piece')->nullable();
            $table->string('numero_piece')->nullable();
            $table->string('extrait')->nullable();
            $table->longText('motif')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('numero_acte')->nullable();
            $table->string('nb_copie')->nullable();
            $table->string('lieu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copie_integrales');
    }
};
