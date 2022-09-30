<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Orchid\Platform\Models\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, HasLocalePreference
{
    use Notifiable, Loggable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'contact_number',
        'username',
        'email',
        'password',
        'permissions',
        'profile_id',
        'profile_type',
        'locale',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    protected $casts = [
        'name' => 'string',
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'permissions' => 'array',
        'email_verified_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'permissions',
        'updated_at',
        'created_at',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'updated_at',
        'created_at',
    ];

    protected $with = [
        'profile',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFullNameWithRoleAttribute()
    {
        $roles = $this->roles->pluck('name')->implode(' / ');

        return "{$this->first_name} {$this->last_name} - $roles";
    }

    public function profile(): MorphTo
    {
        return $this->morphTo();
    }

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
        return [];
    }

    public function preferredLocale(): ?string
    {
        return $this->locale;
    }

    public function searchableAs(): string
    {
        return 'users_first_name_middle_name_last_name_index';
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
        ];
    }
}
