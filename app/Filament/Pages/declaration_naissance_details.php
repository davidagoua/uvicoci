<?php

namespace App\Filament\Pages;

use App\Models\DeclarationNaissance;
use Filament\Pages\Page;

class declaration_naissance_details extends Page
{
    public ?DeclarationNaissance $record = null;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.declaration_naissance_details';
    protected static ?string $title = 'Détails de la déclaration de naissance';
    protected static bool $shouldRegisterNavigation = false;

    public function mount(): void
    {
        $this->record = DeclarationNaissance::where('id', request()->query('id'))->first();
    }

    protected function getViewData(): array
    {
        return [
            'record' => $this->record,
            'certificat_naissance_url' => $this->record->certificat_naissance ? asset('storage/' . $this->record->certificat_naissance) : null,
            'piece_identite_pere_url' => $this->record->piece_identite_pere ? asset('storage/' . $this->record->piece_identite_pere) : null,
            'piece_identite_mere_url' => $this->record->piece_identite_mere ? asset('storage/' . $this->record->piece_identite_mere) : null,
        ];
    }
}
