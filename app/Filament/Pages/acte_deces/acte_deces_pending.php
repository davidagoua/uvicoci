<?php

namespace App\Filament\Pages\acte_deces;

use App\Models\ActeDeces;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;


class acte_deces_pending extends Page implements HasTable
{
    use InteractsWithTable;
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.acte_deces_pending';
    protected static ?string $navigationLabel = "Acte de decès";
    protected static ?string $navigationGroup = "Demandes";
    protected static ?string $title = 'Acte de decès en cours';


    public static function getNavigationBadge(): ?string
    {
        return ActeDeces::query()->whereStatus(0)->count();
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(ActeDeces::query()->orderBy('created_at', 'desc')->whereStatus(0))
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

            ;
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('exporter')
                ->form([
                    TextInput::make('email')
                ])
                ->label("Exporter")
        ];
    }
}
