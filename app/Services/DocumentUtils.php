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
    public static function getModelByType(string $type)
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

    public static function statusCodeToString(int $statusCode): string
    {
        switch ($statusCode){
            case 0:
                return 'En attente';
                break;
            case 700:
                return 'livré';
                break;
            case 100:
                return "Approuvé";
                break;
            case 300:
                return "Pose du timbre";
                break;
            case 600:
                return "En cours de livraison";
                break;
            default:
                return "";
        }
    }
}
