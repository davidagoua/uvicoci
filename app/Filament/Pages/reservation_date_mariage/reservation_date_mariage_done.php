<?php

namespace App\Filament\Pages\reservation_date_mariage;

use App\Models\DateMariage;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class reservation_date_mariage_done extends Page implements HasTable
{
    use InteractsWithTable;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.reservation_date_mariage_done';
    protected static ?string $title = 'Réservations de date de mariage terminées';
    protected static ?string $navigationLabel = "Date de mariage";
    protected static ?string $navigationGroup = "Impressions";

    public function table(Table $table): Table
    {
        return $table
            ->query(DateMariage::query()->where('status', 100))
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return DateMariage::where('status', 100)->count();
    }
}
