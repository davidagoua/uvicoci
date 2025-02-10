<?php

namespace App\Services;

use App\Models\ActeDeces;
use App\Models\ActeMariage;
use App\Models\ActeNaissance;
use App\Models\CopieIntegrale;
use App\Models\DateMariage;
use App\Models\DeclarationNaissance;

class DocumentUtils
{
    public function getModelByType(string $type)
    {
        switch ($type){
            case 'ActeDeces':
                return ActeDeces::class;
                break;
            case 'DeclarationNaissance':
                return DeclarationNaissance::class;
                break;
            case 'CopieIntegrale':
                return CopieIntegrale::class;
                break;
            case 'ActeNaissance':
                return ActeNaissance::class;
                break;
            case 'ActeMariage':
                return ActeMariage::class;
                break;
            case 'DateMariage':
                return DateMariage::class;
                break;
            default: return "";
        }
    }
}
