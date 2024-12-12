<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class acte_mariage_done extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.acte_mariage_done';
    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Acte de mariage";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }
}
