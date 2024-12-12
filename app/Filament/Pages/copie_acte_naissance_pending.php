<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class copie_acte_naissance_pending extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.copie_acte_naissance_pending';
    protected static ?string $navigationLabel = "En cours";
    protected static ?string $navigationGroup = "Copie intégrale d'acte de naissance";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }
}
