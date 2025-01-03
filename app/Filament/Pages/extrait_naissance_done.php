<?php

namespace App\Filament\Pages;

use App\Models\ActeNaissance;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class extrait_naissance_done extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.extrait_naissance_done';
    protected static ?string $title = 'Extraits de naissance terminés';
    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Extrait de naissance";

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeNaissance::query()->where('status', 100))
            ->columns([
                TextColumn::make('numero_acte')
                    ->label('Numéro d\'acte')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nom')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('prenoms')
                    ->label('Prénoms')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_naissance')
                    ->label('Date de naissance')
                    ->date()
                    ->sortable(),
                TextColumn::make('lieu_naissance')
                    ->label('Lieu de naissance')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Date de création')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return ActeNaissance::where('status', 100)->count();
    }
}
