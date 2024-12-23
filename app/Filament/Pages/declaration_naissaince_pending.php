<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\DeclarationNaissance;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;

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
                TextColumn::make('nom_enfant')->label('Nom')->searchable()->sortable(),
                TextColumn::make('prenoms_enfant')->label('Prénoms')->searchable()->sortable(),
                TextColumn::make('date_naissance')->label('Date Naissance')->date()->sortable(),
                TextColumn::make('lieu_naissance')->label('Lieu Naissance')->searchable(),
                TextColumn::make('nom_pere')->label('Nom Père')->searchable(),
                TextColumn::make('nom_mere')->label('Nom Mère')->searchable(),
            
                TextColumn::make('status')->label('Statut')
                    ->getStateUsing(function ($record) {
                        if ($record->status == 0) {
                            return "En attente";
                        } elseif ($record->status == 100) {
                            return "Approuvé";
                        } else {
                            return "Rejeté";
                        }
                    })
                    ->badge()
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('consulter')
                    ->button()
                    ->url(fn ($record) => declaration_naissance_details::getUrl(['id'=>$record->id]))
                    ->icon('heroicon-o-eye'),
                
                DeleteAction::make('supprimer')->iconButton()->icon('heroicon-o-trash')
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkAction::make('exporter')->label("Exporter"),
                DeleteBulkAction::make('supprimer')->requiresConfirmation()
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
