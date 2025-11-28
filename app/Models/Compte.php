<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = ['RIB', 'solde', 'client_id', 'statut', 'date_ouverture'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
