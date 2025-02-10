<?php

namespace App\Filament\Pages\acte_mariage;

use Filament\Pages\Page;

class ActeMariageDetails extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.acte-mariage-details';
}
