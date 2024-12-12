<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class acte_deces_pending extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.acte_deces_pending';
    protected static ?string $navigationLabel = "En cours";
    protected static ?string $navigationGroup = "Acte de decès";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }
}
