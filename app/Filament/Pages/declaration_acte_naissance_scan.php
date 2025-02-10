<?php

namespace App\Filament\Pages;

use App\Models\ActeMariage;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class declaration_acte_naissance_scan extends Page implements HasTable
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = "Scans";
    protected static string $view = 'filament.pages.declaration_acte_naissance_scan';
    protected static ?string $title = "Déclaration Acte Naissance";
    protected static ?string $navigationLabel = "Déclaration Acte Naissance";

    use InteractsWithTable;


    public static function getNavigationBadge(): ?string
    {
        return ActeMariage::query()->whereStatus(500)->count();
    }

    public function query(): Builder
    {
        return ActeMariage::query()->whereStatus(500);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeMariage::query()->orderBy('created_at', 'desc')->whereStatus(500))
            ->columns([
                TextColumn::make('created_at')->label("Date de création"),
                IconColumn::make('owner')
                    ->label('Titulaire')
                    ->icon(fn (string $state): string =>  [
                        true => 'heroicon-o-check-circle',
                        false => 'heroicon-o-x-circle',
                    ][$state]),
                TextColumn::make('email'),
                TextColumn::make('telephone'),
                TextColumn::make('numero_piece'),

            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('consulter')
                    ->button()
                    ->url(fn ($record) => ActeMariageDetails::getUrl(['id'=>$record->id]))
                    ->icon('heroicon-o-eye'),
                EditAction::make('supprimer')->iconButton()->icon('heroicon-o-pencil'),
                DeleteAction::make('supprimer')->iconButton()->icon('heroicon-o-trash')
            ])

            ;
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('exporter')->label("Scanner")
        ];
    }
}
