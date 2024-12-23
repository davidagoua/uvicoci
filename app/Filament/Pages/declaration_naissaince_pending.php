<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\DeclarationNaissance;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class declaration_naissaince_pending extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.declaration_naissaince_pending';
    protected static ?string $navigationLabel = "En cours";
    protected static ?string $navigationGroup = "Déclaration de naissance";

    public function table(Table $table): Table
    {
        return $table
            ->query(DeclarationNaissance::query()->where('status', 0))
            ->columns([
                TextColumn::make('nom')->label('Nom')->searchable()->sortable(),
                TextColumn::make('prenoms')->label('Prénoms')->searchable()->sortable(),
                TextColumn::make('date_naissance')->label('Date Naissance')->date()->sortable(),
                TextColumn::make('lieu_naissance')->label('Lieu Naissance')->searchable(),
                TextColumn::make('nom_pere')->label('Nom Père')->searchable(),
                TextColumn::make('nom_mere')->label('Nom Mère')->searchable(),
                TextColumn::make('hopital')->label('Hôpital')->searchable(),
                TextColumn::make('status')->label('Statut')->badge()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        0 => 'En attente',
                        100 => 'Approuvé',
                        200 => 'Rejeté',
                    ])
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return DeclarationNaissance::where('status', 0)->count();
    }
}
