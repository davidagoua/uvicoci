<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\DateMariage;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class reservation_date_mariage_pending extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.reservation_date_mariage_pending';
    protected static ?string $navigationLabel = "En cours";
    protected static ?string $navigationGroup = "Demandes";

    public function table(Table $table): Table
    {
        return $table
            ->query(DateMariage::query()->where('status', 0))
            ->columns([
                TextColumn::make('nom_epoux')->label('Nom Époux')->searchable()->sortable(),
                TextColumn::make('prenom_epoux')->label('Prénom Époux')->searchable()->sortable(),
                TextColumn::make('nom_epouse')->label('Nom Épouse')->searchable()->sortable(),
                TextColumn::make('prenom_epouse')->label('Prénom Épouse')->searchable()->sortable(),
                TextColumn::make('date_mariage')->label('Date Mariage')->date()->sortable(),
                TextColumn::make('heure_mariage')->label('Heure Mariage')->sortable(),
                TextColumn::make('lieu_mariage')->label('Lieu Mariage')->searchable(),
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
        return DateMariage::where('status', 0)->count();
    }
}
