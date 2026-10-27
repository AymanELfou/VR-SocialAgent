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
    Schema::create('messages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('conversation_id')->constrained()->cascadeOnDelete();
        
        // Optimisation Webhook : Le "unique" bloque les doublons si Meta renvoie la requête
        $table->string('external_message_id')->unique(); 
        
        $table->text('content');
        $table->string('sender_type'); // 'customer', 'ai_agent', 'human'
        $table->string('status')->default('delivered'); // delivered, failed, processing
        
        // Optimisation IA : Traçabilité financière de l'API OpenAI
        $table->integer('prompt_tokens')->nullable();
        $table->integer('completion_tokens')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
