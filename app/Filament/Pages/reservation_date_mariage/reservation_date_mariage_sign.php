<?php

namespace App\Filament\Pages\reservation_date_mariage;

use App\Filament\Pages\acte_mariage\DateMariageDetails;
use App\Models\DateMariage;
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

class reservation_date_mariage_sign extends Page implements HasTable
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = "Signature & Timbre";
    protected static string $view = 'filament.pages.reservation_date_mariage_sign';

    protected static ?string $title = "Reservation date mariage";

    use InteractsWithTable;


    public static function getNavigationBadge(): ?string
    {
        return DateMariage::query()->whereStatus(300)->count();
    }

    public function query(): Builder
    {
        return DateMariage::query()->whereStatus(300);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(DateMariage::query()->orderBy('created_at', 'desc')->whereStatus(300))
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
                    ->url(fn ($record) => ReservationDateMariageDetail::getUrl(['id'=>$record->id]))
                    ->icon('heroicon-o-eye'),
                EditAction::make('supprimer')->iconButton()->icon('heroicon-o-pencil'),
                DeleteAction::make('supprimer')->iconButton()->icon('heroicon-o-trash')
            ])

            ;
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('Exporter')
                ->label("Exporter")
                ->form([
                    FileUpload::make('file')
                ])
                ->action(function(array $data){

                })
        ];
    }
}
