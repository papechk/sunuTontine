<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membre extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tontine_id',
        'statut',
        'date_adhesion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }

    public function cotisations()
    {
        return $this->hasMany(Cotisation::class);
    }
}
