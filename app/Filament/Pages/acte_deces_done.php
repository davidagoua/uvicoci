<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class acte_deces_done extends Page
{

    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.acte_deces_done';
    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Acte de decès";

    public static function getNavigationBadge(): ?string
    {
        return 0;
    }

    public function table()
    {
        return [
            TextColumn::make('owner')
        ];
    }
}
