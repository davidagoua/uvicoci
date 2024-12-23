<?php

namespace App\Filament\Pages;

use App\Models\DeclarationNaissance;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class declaration_naissaince_done extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.declaration_naissaince_done';
    protected static ?string $title = 'Déclarations de naissance terminées';
    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Déclaration de naissance";

    public function table(Table $table): Table
    {
        return $table
            ->query(DeclarationNaissance::query()->where('status', 100))
            ->columns([
                TextColumn::make('nom_enfant')
                    ->label('Nom de l\'enfant')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('prenoms_enfant')
                    ->label('Prénoms de l\'enfant')
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
        return DeclarationNaissance::where('status', 100)->count();
    }
}
