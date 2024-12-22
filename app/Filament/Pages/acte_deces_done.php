<?php

namespace App\Filament\Pages;

use App\Models\ActeDeces;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class acte_deces_done extends Page implements HasTable
{

    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.acte_deces_done';
    protected static ?string $title = "";
    protected static ?string $navigationLabel = "Terminés";
    protected static ?string $navigationGroup = "Acte de decès";

    public static function getNavigationBadge(): ?string
    {
        return ActeDeces::query()->whereStatus(100)->count();
    }

    public function query(): Builder
    {
        return ActeDeces::query()->whereStatus(100);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeDeces::query()->whereStatus(100))
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
                    ->url(fn ($record) => ActeDecesDetails::getUrl(['id'=>$record->id]))
                    ->icon('heroicon-o-eye'),
                EditAction::make('supprimer')->iconButton()->icon('heroicon-o-pencil'),
                DeleteAction::make('supprimer')->iconButton()->icon('heroicon-o-trash')
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkAction::make('exporter')->label("Exporter"),
                DeleteBulkAction::make('supprimer')->requiresConfirmation()
            ])
            ;
    }

    public function getHeaderActions(): array
    {
        return [
          Action::make('exporter')->label("Exporter")
        ];
    }
}
