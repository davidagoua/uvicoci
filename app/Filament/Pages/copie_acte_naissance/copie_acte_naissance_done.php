<?php

namespace App\Filament\Pages\copie_acte_naissance;

use App\Models\ActeNaissance;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class copie_acte_naissance_done extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.copie_acte_naissance_done';
    protected static ?string $title = "Copie intégrale d'acte de naissance terminés";
    protected static ?string $navigationLabel = "Copie intégrale d'acte de naissance";
    protected static ?string $navigationGroup = "Impressions";

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
                TextColumn::make('created_at')
                    ->label('Date de création')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('consulter')
                    ->button()
                    ->url(fn ($record) => CopieActeNaissanceDetail::getUrl(['id'=>$record->id]))
                    ->icon('heroicon-o-eye'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return ActeNaissance::where('status', 100)->count();
    }
}
