<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class extrait_naissance_done extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.extrait_naissance_done';

    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Extrait de naissance";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }
}
