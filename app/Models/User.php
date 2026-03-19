<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'email',
        'password',
        'role',
        'gestionnaire_id',
    ];
    // Un gestionnaire a plusieurs tontines
    public function tontines()
    {
        return $this->hasMany(Tontine::class, 'gestionnaire_id');
    }

    // Un participant appartient à un gestionnaire
    public function gestionnaire()
    {
        return $this->belongsTo(User::class, 'gestionnaire_id');
    }

    // Un gestionnaire a plusieurs participants
    public function participants()
    {
        return $this->hasMany(User::class, 'gestionnaire_id');
    }

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
        ];
    }

    public function getSettings(): object
    {
        $sidebarMap = [
            'clair' => 'light',
            'sombre' => 'dark',
            'colore' => 'colored',
            'degrade' => 'gradient',
            'verre' => 'glass',
        ];

        return (object) [
            'primary_color' => config('dashboard.main_color', '#465fff'),
            'sidebar_style' => $sidebarMap[config('dashboard.sidebar_style', 'clair')] ?? 'light',
        ];
    }
}
