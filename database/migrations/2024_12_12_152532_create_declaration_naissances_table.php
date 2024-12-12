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
        Schema::create('declaration_naissances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('owner')->default(false);
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('type_piece')->nullable();
            $table->string('numero_piece')->nullable();
            $table->string('nom_enfant')->nullable();
            $table->string('prenoms_enfant')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('nom_pere')->nullable();
            $table->string('prenoms_pere')->nullable();
            $table->string('nom_mere')->nullable();
            $table->string('prenoms_mere')->nullable();
            $table->string('certificat_naissance')->nullable();
            $table->string('piece_identite_pere')->nullable();
            $table->string('piece_identite_mere')->nullable();

            $table->longText('motif_demande')->nullable();
            $table->string('numero_acte')->nullable();
            $table->string('numero_copie')->nullable();
            $table->string('lieu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaration_naissances');
    }
};
