<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DateMariage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function livraison(): HasOne
    {
        return $this->hasOne(Livraison::class, 'document_id');
    }

    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class, 'document_id');
    }
}
