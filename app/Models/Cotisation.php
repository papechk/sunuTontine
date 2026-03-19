<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cotisation extends Model
{
    use HasFactory;
    protected $fillable = [
        'membre_id',
        'montant',
        'date_paiement',
        'statut',
        'penalite',
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class);
    }
}
