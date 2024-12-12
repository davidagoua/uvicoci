<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class acte_mariage_pending extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.acte_mariage_pending';
    protected static ?string $navigationLabel = "En cours";
    protected static ?string $navigationGroup = "Acte de mariage";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }
}
