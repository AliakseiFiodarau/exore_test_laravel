<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    public const TABLE_NAME = 'users';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const EMAIL_VERIFIED_AT = 'email_verified_at';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';
    public const DATETIME = 'datetime';

    public const ROLE_MANAGER = 'manager';
    public const ROLE_EMPLOYEE = 'employee';

    public const USER_ROLE = 'role';
    public const MANAGER = 'manager';

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
        self::USER_ROLE,
        self::MANAGER
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::EMAIL_VERIFIED_AT => self::DATETIME,
    ];

    /**
     * get collection of posts of the user
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(
            Post::class,
            Post::POSTED_BY,
            'id'
        );
    }
}
