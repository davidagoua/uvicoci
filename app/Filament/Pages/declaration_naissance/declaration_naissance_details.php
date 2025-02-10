<?php

namespace App\Filament\Pages\declaration_naissance;

use App\Filament\Pages\acte_mariage\acte_mariage_done;
use App\Filament\Pages\acte_mariage\acte_mariage_livraison;
use App\Filament\Pages\acte_mariage\acte_mariage_pending;
use App\Filament\Pages\acte_mariage\acte_mariage_sign;
use App\Models\DeclarationNaissance;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
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

    public function getHeaderActions(): array
    {
        return [
            Action::make('Rapport')
                ->icon('heroicon-o-arrow-down-tray'),

            Action::make('Approuver')
                ->color('success')
                ->action(function () {
                    $this->record->status = 100;
                    $this->record->save();
                    Notification::make()->title("Demande approuvée")->success()->send();
                    redirect(declaration_naissaince_pending::getUrl());
                })
                ->visible($this->record->status == 0)
                ->icon('heroicon-o-check-circle'),

            Action::make('signature')
                ->label("Envoyer pour signature")
                ->color('success')
                ->action(function () {
                    $this->record->status = 300;
                    $this->record->save();
                    Notification::make()->title("Demande envoyé pour signature")->info()->send();
                    redirect(declaration_naissaince_done::getUrl());
                })
                ->visible($this->record->status == 100)
                ->icon('heroicon-o-square-2-stack'),

            Action::make('livraison')
                ->label("Livraison")
                ->color('success')
                ->action(function () {
                    $this->record->status = 600;
                    $this->record->save();
                    Notification::make()->title("Demande envoyé pour livraison")->info()->send();
                    redirect(declaration_acte_naissance_sign::getUrl());
                })
                ->visible($this->record->status == 300)
                ->icon('heroicon-o-truck'),

            Action::make('Délivre')
                ->label("Délivré")
                ->color('success')
                ->action(function () {
                    $this->record->status = 700;
                    $this->record->save();
                    Notification::make()->title("Demande mise à jour")->info()->send();
                    redirect(declaration_acte_naissance_livraison::getUrl());
                })
                ->visible($this->record->status == 600)
                ->icon('heroicon-o-check-circle'),

            Action::make('Refuser')
                ->color('danger')
                ->action(function () {
                    $this->record->status = 200;
                    $this->record->save();
                    Notification::make()->title("Demande refusée")->info()->send();
                    redirect(declaration_naissaince_pending::getUrl());
                })
                ->icon('heroicon-o-x-circle')
        ];
    }
}
