<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public const ROLE_USER = 'user';

    public const ROLE_PARTNER = 'partner';

    public const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_guest',
        'avatar_path',
        'city',
        'postal_prefix',
        'preferences',
        'total_points',
        'account_type',
        'social_links',
        'occupation',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_guest' => 'boolean',
            'preferences' => 'array',
            'total_points' => 'integer',
            'social_links' => 'array',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Only admins may access the Filament panel (docs/SECURITY.md §1).
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    /** @return HasMany<Sort, $this> */
    public function sorts(): HasMany
    {
        return $this->hasMany(Sort::class);
    }

    /** @return HasMany<Bundle, $this> */
    public function bundles(): HasMany
    {
        return $this->hasMany(Bundle::class);
    }

    /** @return HasMany<ChatConversation, $this> */
    public function chatConversations(): HasMany
    {
        return $this->hasMany(ChatConversation::class);
    }

    /** @return HasMany<ChallengeProgress, $this> */
    public function challengeProgress(): HasMany
    {
        return $this->hasMany(ChallengeProgress::class);
    }

    /** @return HasMany<CommunityTip, $this> */
    public function communityTips(): HasMany
    {
        return $this->hasMany(CommunityTip::class);
    }
}
