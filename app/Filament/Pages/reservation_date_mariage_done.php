<?php

namespace App\Filament\Pages;

use App\Models\DateMariage;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class reservation_date_mariage_done extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.reservation_date_mariage_done';
    protected static ?string $title = 'Réservations de date de mariage terminées';
    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Impressions";

    public function table(Table $table): Table
    {
        return $table
            ->query(DateMariage::query()->where('status', 100))
            ->columns([
                TextColumn::make('nom_epoux')
                    ->label('Nom de l\'époux')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nom_epouse')
                    ->label('Nom de l\'épouse')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_mariage')
                    ->label('Date de mariage')
                    ->date()
                    ->sortable(),
                TextColumn::make('heure_mariage')
                    ->label('Heure de mariage')
                    ->time()
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
        return DateMariage::where('status', 100)->count();
    }
}
