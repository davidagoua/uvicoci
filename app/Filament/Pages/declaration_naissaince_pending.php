<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class declaration_naissaince_pending extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.declaration_naissaince_pending';
    protected static ?string $navigationLabel = "En cours";
    protected static ?string $navigationGroup = "Declaration de naissance";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }
}
