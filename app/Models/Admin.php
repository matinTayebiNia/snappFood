<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "name", "email", "phone", "address", "password", "adminType"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isSuperuser(): bool
    {
        return $this->adminType === "superuser";
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission): bool
    {
        return $this->permissions->contains('name', $permission->name) || $this->hasRole($permission->roles);
    }

    private function hasRole($Roles): bool
    {
        return !!$Roles->intersect($this->roles)->all();
    }
}
