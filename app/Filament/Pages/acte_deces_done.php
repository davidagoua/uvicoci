<?php

namespace App\Filament\Pages;

use App\Models\ActeDeces;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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

    public function query(): Builder
    {
        return ActeDeces::query();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeDeces::query())
            ->columns([
                TextColumn::make('owner')->badge(),
                TextColumn::make('email'),
                TextColumn::make('telephone'),
                TextColumn::make('numero_piece'),
                TextColumn::make('nom_prenom')
                    ->label("Nom& Prénoms defunt")
                    ->getStateUsing(fn ($state) => $state->nom_defunt . ' '. $state->prenoms_defunt),
            ])->actions([
                \Filament\Tables\Actions\Action::make('exporter')->label("Exporter")
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
