<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class declaration_naissaince_done extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.declaration_naissaince_done';
    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Declaration de naissance";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }

}
