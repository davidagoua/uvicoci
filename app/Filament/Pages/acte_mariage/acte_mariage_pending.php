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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class acte_mariage_pending extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.acte_mariage_pending';

    protected static ?string $navigationLabel = "Acte de mariage";

    protected static ?string $navigationGroup = "Demandes";

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeMariage::query()->where('status', 0))
            ->columns([
                TextColumn::make('numero_acte')->label('Numéro Acte')->searchable()->sortable(),
                TextColumn::make('nom_epoux')->label('Nom Époux')->searchable()->sortable(),
                TextColumn::make('prenoms_epoux')->label('Prénom Époux')->searchable()->sortable(),
                TextColumn::make('nom_epouse')->label('Nom Épouse')->searchable()->sortable(),
                TextColumn::make('prenoms_epouse')->label('Prénom Épouse')->searchable()->sortable(),
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('consulter')
                    ->button()
                    ->url(fn ($record) => ActeMariageDetails::getUrl(['id'=>$record->id]))
                    ->icon('heroicon-o-eye'),
                EditAction::make('modifier')->iconButton()
                    ->icon('heroicon-o-pencil')
                    ->form([
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        // ...
                    ]),
                DeleteAction::make('supprimer')->iconButton()->icon('heroicon-o-trash')
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
        return ActeMariage::where('status', 0)->count();
    }
}
