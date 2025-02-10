<?php

namespace App\Filament\Pages\reservation_date_mariage;

use App\Filament\Pages\acte_mariage\ActeMariageDetails;
use App\Models\DateMariage;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class reservation_date_mariage_pending extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.reservation_date_mariage_pending';
    protected static ?string $navigationLabel = "Reservation Date de mariage";
    protected static ?string $title = "Reservation Date de mariage";
    protected static ?string $navigationGroup = "Demandes";

    public function table(Table $table): Table
    {
        return $table
            ->query(DateMariage::query()->where('status', 0))
            ->columns([
                TextColumn::make('telephone')->label('Téléphone')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable()->sortable(),

            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('consulter')
                    ->button()
                    ->url(fn ($record) => ReservationDateMariageDetail::getUrl(['id'=>$record->id]))
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
        return DateMariage::where('status', 0)->count();
    }
}
