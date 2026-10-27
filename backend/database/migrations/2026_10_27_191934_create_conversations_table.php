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
    Schema::create('conversations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('social_account_id')->constrained()->cascadeOnDelete();
        $table->string('external_conversation_id'); 
        $table->string('status')->default('active'); // active, paused, closed
        $table->timestamps();

        // Index combiné pour accélérer la recherche par LangChain
        $table->unique(['social_account_id', 'external_conversation_id'], 'social_ext_conv_unique');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
