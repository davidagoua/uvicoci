<?php

namespace App\Filament\Pages\copie_acte_naissance;

use App\Filament\Pages\acte_mariage\ActeMariageDetails;
use App\Models\ActeNaissance;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class copie_acte_naissance_pending extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.copie_acte_naissance_pending';
    protected static ?string $navigationLabel = "Copie intégrale d'acte de naissance";
    protected static ?string $title = "Copie intégrale d'acte de naissance";
    protected static ?string $navigationGroup = "Demandes";

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeNaissance::query()->where('status', 0))
            ->columns([
                TextColumn::make('numero_acte')->label('Numéro Acte')->searchable()->sortable(),
                TextColumn::make('telephone')->label('Téléphone')->searchable()->sortable(),
                TextColumn::make('status')->label('Statut')->badge()
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('consulter')
                    ->button()
                    ->url(fn ($record) => CopieActeNaissanceDetail::getUrl(['id'=>$record->id]))
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return ActeNaissance::where('status', 0)->count();
    }
}
