<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineReaction extends Model
{
    use HasFactory;
    protected $fillable = ['timeline_id', 'user_id'];
}
