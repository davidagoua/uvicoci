<?php

namespace App\Filament\Pages;

use App\Models\ActeDeces;
use Filament\Actions\Action;
use Filament\Pages\Page;

class ActeDecesDetails extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.acte-deces-details';
    public ActeDeces $acteDeces;

    public function mount()
    {
        $this->acteDeces = ActeDeces::query()->whereId(request()->query('id'))->first();
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('Rapport')
                ->icon('heroicon-o-arrow-down-tray'),

            Action::make('Approuver')
                ->color('success')
                ->icon('heroicon-o-check-circle'),

            Action::make('Refuser')
                ->color('danger')
                ->icon('heroicon-o-x-circle'),
        ];
    }
}
