<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversacion_id');
            $table->unsignedBigInteger('remitente_id');
            $table->unsignedBigInteger('destinatario_id');
            $table->text('mensaje');
            $table->boolean('leido')->default(false);
            $table->timestamps();
            
            $table->foreign('conversacion_id')->references('id')->on('conversaciones')->onDelete('cascade');
            $table->foreign('remitente_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('destinatario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};