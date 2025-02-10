<?php

namespace App\Filament\Pages\acte_mariage;

use App\Filament\Pages\acte_deces\ActeDecesDetails;
use App\Models\ActeMariage;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class acte_mariage_done extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.acte_mariage_done';
    protected static ?string $title = 'Acte de mariage terminés';
    protected static ?string $navigationLabel = "Acte de mariage";
    protected static ?string $navigationGroup = "Impressions";

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeMariage::query()->where('status', 100))
            ->columns([
                TextColumn::make('numero_acte')
                    ->label('Numéro d\'acte')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nom_epoux')
                    ->label('Nom de l\'époux')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nomçepouse')
                    ->label('Nom de l\'épouse')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_mariage')
                    ->label('Date de mariage')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Date de création')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([

            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('consulter')
                    ->button()
                    ->url(fn ($record) => ActeMariageDetails::getUrl(['id'=>$record->id]))
                    ->icon('heroicon-o-eye'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return ActeMariage::where('status', 100)->count();
    }
}
