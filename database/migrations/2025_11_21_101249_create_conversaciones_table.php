<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('coach_id');
            $table->string('asunto')->nullable();
            $table->timestamp('ultimo_mensaje_at')->nullable();
            $table->timestamps();
            
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['admin_id', 'coach_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversaciones');
    }
};