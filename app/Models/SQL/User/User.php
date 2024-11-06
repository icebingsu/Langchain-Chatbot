<?php

namespace App\Models\SQL\User;

use App\Models\SQL\Subcription\CommissionHistory;
use App\Models\SQL\Subcription\PromotionCode;
use App\Models\SQL\Subcription\Subcription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;
use MongoDB\Laravel\Relations\HasMany;
use MongoDB\Laravel\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "fullname",
        "email",
        "phone",
        "address",
        "avatar",
        "password",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // "id",
        "is_banned",
        "password",
        // "updated_at",
        // "created_at",
        // 'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // password as hashed for automatically hashing with bcrypt when saving model
            "password" => "hashed",
        ];
    }

    /**
     * Define default values for columns
     *
     * @return array<string, any>
     */
    protected $attributes = [
        "is_banned" => false,
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            "clientType" => $this->type_id,
            "scope" => $this->getSelfScope(),
        ];
    }

    /**
     * Return this user's permission scope.
     *
     * @return array
     */
    public function getSelfScope(): array
    {
        return ["*"];
    }

    // === RELATIONS

    public function subcriptions(): HasMany
    {
        return $this->hasMany(Subcription::class, "user_id");
    }

    public function promotionCodes(): HasMany
    {
        return $this->hasMany(PromotionCode::class, "partner_id");
    }

    public function commissionHistory(): HasOne
    {
        return $this->hasOne(CommissionHistory::class, "user_id");
    }
}
