<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'tontine_id',
        'date_cotisation',
        'montant',
    ];

    public function tontine()
    {
        return $this->belongsTo(Tontine::class);
    }
}
