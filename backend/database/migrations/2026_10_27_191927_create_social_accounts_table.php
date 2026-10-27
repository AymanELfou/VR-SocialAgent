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
    Schema::create('social_accounts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('business_profile_id')->constrained()->cascadeOnDelete();
        $table->string('platform'); // 'instagram' ou 'tiktok'
        $table->string('platform_account_id');
        $table->text('access_token');
        
        // Optimisations pour le renouvellement des sessions OAuth
        $table->text('refresh_token')->nullable();
        $table->timestamp('expires_at')->nullable();
        $table->timestamps();

        // Empêche de lier le même compte Instagram deux fois
        $table->unique(['platform', 'platform_account_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_accounts');
    }
};
