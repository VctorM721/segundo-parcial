<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void {
  Schema::create('students', function (Blueprint $t) {
    $t->id();
    $t->string('carne', 20)->unique();
    $t->string('nombres');
    $t->string('apellidos');
    $t->string('dpi', 20)->nullable();
    $t->string('nit', 20)->nullable();
    $t->string('email1');
    $t->string('email2')->nullable();
    $t->string('tel1')->nullable();
    $t->string('tel2')->nullable();
    $t->enum('tipo', ['nuevo','traslado','equivalencia','reingreso']);
    $t->foreignId('facultad_id')->constrained('facultades')->cascadeOnDelete();
    $t->string('dpi_path')->nullable();
    $t->timestamps();
  });
}

   
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
