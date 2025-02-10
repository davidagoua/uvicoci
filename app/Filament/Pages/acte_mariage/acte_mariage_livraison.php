<?php

namespace App\Filament\Pages\acte_mariage;

use App\Filament\Pages\reservation_date_mariage\ReservationActeMariageDetail;
use App\Models\ActeMariage;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class acte_mariage_livraison extends Page implements  HasTable
{
    //protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = "Livraisons";
    protected static string $view = 'filament.pages.acte_mariage_livraison';

    protected static ?string $title = "Acte Mariage";

    use InteractsWithTable;


    public static function getNavigationBadge(): ?string
    {
        return ActeMariage::query()->whereStatus(600)->count();
    }

    public function query(): Builder
    {
        return ActeMariage::query()->whereStatus(600);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeMariage::query()->orderBy('created_at', 'desc')->whereStatus(600))
            ->columns([
                TextColumn::make('created_at')->label("Date de création"),
                IconColumn::make('owner')
                    ->label('Titulaire')
                    ->icon(fn(string $state): string => [
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
                    ->url(fn($record) => ActeMariageDetails::getUrl(['id' => $record->id]))
                    ->icon('heroicon-o-eye'),
                EditAction::make('supprimer')->iconButton()->icon('heroicon-o-pencil'),
                DeleteAction::make('supprimer')->iconButton()->icon('heroicon-o-trash')
            ]);
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('Exporter')
                ->label("Exporter")
                ->form([
                    FileUpload::make('file')
                ])
                ->action(function (array $data) {

                })
        ];
    }













































































}
