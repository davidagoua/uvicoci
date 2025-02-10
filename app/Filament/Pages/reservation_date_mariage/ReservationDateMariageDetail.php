<?php

namespace App\Filament\Pages\reservation_date_mariage;

use App\Filament\Pages\acte_mariage\acte_mariage_done;
use App\Filament\Pages\acte_mariage\acte_mariage_livraison;
use App\Filament\Pages\acte_mariage\acte_mariage_pending;
use App\Filament\Pages\acte_mariage\acte_mariage_sign;
use App\Models\ActeMariage;
use App\Models\DateMariage;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ReservationDateMariageDetail extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.reservation_date_mariage.reservation-date-mariage-detail';

    public DateMariage|null $document;

    public function mount()
    {
        $this->document = DateMariage::query()->whereId(request()->query('id'))->first();
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('Rapport')
                ->icon('heroicon-o-arrow-down-tray'),

            Action::make('Approuver')
                ->color('success')
                ->action(function () {
                    $this->document->status = 100;
                    $this->document->save();
                    Notification::make()->title("Demande approuvée")->success()->send();
                    redirect(reservation_date_mariage_pending::getUrl());
                })
                ->visible($this->document->status == 0)
                ->icon('heroicon-o-check-circle'),

            Action::make('signature')
                ->label("Envoyer pour signature")
                ->color('success')
                ->action(function () {
                    $this->document->status = 300;
                    $this->document->save();
                    Notification::make()->title("Demande envoyé pour signature")->info()->send();
                    redirect(reservation_date_mariage_done::getUrl());
                })
                ->visible($this->document->status == 100)
                ->icon('heroicon-o-square-2-stack'),

            Action::make('livraison')
                ->label("Livraison")
                ->color('success')
                ->action(function () {
                    $this->document->status = 600;
                    $this->document->save();
                    Notification::make()->title("Demande envoyé pour livraison")->info()->send();
                    redirect(reservation_date_mariage_sign::getUrl());
                })
                ->visible($this->document->status == 300)
                ->icon('heroicon-o-truck'),

            Action::make('Délivre')
                ->label("Délivré")
                ->color('success')
                ->action(function () {
                    $this->document->status = 700;
                    $this->document->save();
                    Notification::make()->title("Demande mise à jour")->info()->send();
                    redirect(reservation_date_mariage_livraison::getUrl());
                })
                ->visible($this->document->status == 600)
                ->icon('heroicon-o-check-circle'),

            Action::make('Refuser')
                ->color('danger')
                ->action(function () {
                    $this->document->status = 200;
                    $this->document->save();
                    Notification::make()->title("Demande refusée")->info()->send();
                    redirect(reservation_date_mariage_pending::getUrl());
                })
                ->icon('heroicon-o-x-circle')
        ];
    }
}
