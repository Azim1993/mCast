<?php

namespace App\Models;

use App\Data\Enums\MediaTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'src',
        'type',
        'mediaable_type',
        'mediaable_id'
    ];


    protected $casts = [
        'type' => MediaTypeEnum::class
    ];

    public function src(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?
                (
                filter_var($value, FILTER_VALIDATE_URL) ?
                    $value :
                    asset('/storage/' . $value)
                ) :
                null
        );
    }
}
