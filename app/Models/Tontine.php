<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Tontine extends Model
{
    use HasFactory;
    // Scope pour filtrer par gestionnaire connecté
    protected $fillable = [
        'nom',
        'montant_cotisation',
        'frequence',
        'date_debut',
        'gestionnaire_id',
        'statut',
    ];

    public function gestionnaire()
    {
        return $this->belongsTo(User::class, 'gestionnaire_id');
    }

    public function membres()
    {
        return $this->hasMany(Membre::class);
    }

    public function calendriers()
    {
        return $this->hasMany(Calendrier::class);
    }

        public function scopePourGestionnaire($query, $gestionnaireId = null)
    {
        $id = $gestionnaireId ?? (request()->user() ? request()->user()->id : null);
        return $query->where('gestionnaire_id', $id);
    }
}
