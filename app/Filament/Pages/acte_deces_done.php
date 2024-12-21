<?php

namespace App\Filament\Pages;

use App\Models\ActeDeces;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
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
        return ActeDeces::query()->count();
    }

    public function query(): Builder
    {
        return ActeDeces::query();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeDeces::query())
            ->columns([
                TextColumn::make('created_at')->label("Date de création"),
                IconColumn::make('status')
                    ->icon(fn (string $state): string =>  [
                        0 => 'heroicon-o-check',
                        1 => 'heroicon-o-times',
                    ][$state]),
                TextColumn::make('email'),
                TextColumn::make('telephone'),
                TextColumn::make('numero_piece'),

            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('consulter')
                    ->button()
                    ->icon('heroicon-o-eye')
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkAction::make('exporter')->label("Exporter"),
                DeleteBulkAction::make('supprimer')
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
