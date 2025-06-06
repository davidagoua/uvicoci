<?php

namespace App\Filament\Pages\acte_deces;

use App\Filament\Pages\scan;
use App\Models\ActeDeces;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class acte_deces_scan extends Page implements HasTable
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = "Scans";
    protected static ?string $navigationLabel = "Acte de decès";
    protected static ?string $title = "Acte de decès";
    protected static string $view = 'filament.pages.acte_deces_scan';

    use InteractsWithTable;


    public static function getNavigationBadge(): ?string
    {
        return ActeDeces::query()->whereStatus(500)->count();
    }

    public function query(): Builder
    {
        return ActeDeces::query()->whereStatus(500);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ActeDeces::query()->orderBy('created_at', 'desc')->whereStatus(500))
            ->columns([
                TextColumn::make('created_at')->label("Date de création"),
                IconColumn::make('owner')
                    ->label('Titulaire')
                    ->icon(fn (string $state): string =>  [
                        true => 'heroicon-o-check-circle',
                        false => 'heroicon-o-x-circle',
                    ][(bool) $state]),
                TextColumn::make('nom_defunt'),
                TextColumn::make('prenoms_defunt'),
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

            ;
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('scanner')
                ->label("Numeriser")
                ->icon('heroicon-o-clipboard-document-check')
                ->url(scan::getUrl(['type_document'=>'ActeDeces'])),
        ];
    }
}
