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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('document_id');
            $table->string('document_type');
            $table->string('adresse')->nullable();
            $table->string('nom_prenom')->nullable();
            $table->string('contact')->nullable();
            $table->integer('status')->default(0);
            $table->string('id_document')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
