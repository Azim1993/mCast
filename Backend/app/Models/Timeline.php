<?php

namespace App\Models;

use App\Data\Enums\PreviewPrivacyTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'preview_privacy',
        'total_reaction'
    ];

    protected $casts = [
        'preview_privacy' => PreviewPrivacyTypeEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TimelineComment::class);
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, (new TimelineMedia)->getTable());
    }
}
