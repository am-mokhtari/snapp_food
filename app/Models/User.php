<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'role',
        'current_address_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'role',
        'remember_token',
        'current_address_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function lastCart(): HasOne
    {
        return $this->hasOne(
            Cart::class)->ofMany(
            ['id' => 'max'],
            function (Builder $query) {
                $query->where('is_closed', '=', false);
            });
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => '0' . $value,
        );
    }

    public function createToken(string $name, array $abilities = ['*'], DateTimeInterface $expiresAt = null): NewAccessToken
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(20)),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        /** @var mixed $token */
        return new NewAccessToken($token, $token->getKey() . '|' . $plainTextToken);
    }
}
