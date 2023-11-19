<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'first_name',
        'last_name',
        'profile_pic_src',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Relationships
     */
    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    public function follow(): BelongsToMany
    {
        return $this->belongsToMany(User::class, (new Follower)->getTable(), 'user_id', 'follower_id');
    }

    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function following(): HasMany
    {
        return $this->hasMany(Follower::class, 'user_id');
    }



    /**
     *
     * Accessors
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name .' '. $this->last_name,
        );
    }

    public function profilePicSrc(): Attribute
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
