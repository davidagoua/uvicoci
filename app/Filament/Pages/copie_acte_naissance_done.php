<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class copie_acte_naissance_done extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.copie_acte_naissance_done';
    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Copie d'acte de naissance";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }
}
