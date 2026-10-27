<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiAgent extends Model
{
    protected $table = 'ai_agents';

    protected $fillable = [
        'business_profile_id',
        'system_prompt',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function businessProfile(): BelongsTo
    {
        return $this->belongsTo(BusinessProfile::class);
    }
}
