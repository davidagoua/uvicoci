<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class acte_deces_done extends Page implements HasTable
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
        return Table::make()
            ->columns([
                TextColumn::make('owner')
            ])->actions([
                Action::make('exporter')->label("Exporter")
            ])
            ;
    }

    public function getHeaderActions(): array
    {
        return [
          Action::make('exporter')->label("Exporter")
        ];
    }
}
