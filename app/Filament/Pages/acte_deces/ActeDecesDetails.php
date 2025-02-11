<?php

namespace App\Filament\Pages\acte_deces;

use App\Filament\Pages\acte_mariage\acte_mariage_pending;
use App\Models\ActeDeces;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
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

            Action::make('Approuver')
                ->color('success')
                ->action(function () {
                    $this->acteDeces->status = 100;
                    $this->acteDeces->save();
                    Notification::make()->title("Demande approuvée")->success()->send();
                    redirect(acte_deces_pending::getUrl());
                })
                ->visible($this->acteDeces->status == 0)
                ->icon('heroicon-o-check-circle'),

            Action::make('signature')
                ->label("Envoyer pour signature")
                ->color('success')
                ->action(function () {
                    $this->acteDeces->status = 300;
                    $this->acteDeces->save();
                    Notification::make()->title("Demande envoyé pour signature")->info()->send();
                    redirect(acte_deces_done::getUrl());
                })
                ->visible($this->acteDeces->status == 100 || $this->acteDeces->status == 500)
                ->icon('heroicon-o-square-2-stack'),

            Action::make('livraison')
                ->label("Livraison")
                ->color('success')
                ->action(function () {
                    $this->acteDeces->status = 600;
                    $this->acteDeces->save();
                    Notification::make()->title("Demande envoyé pour livraison")->info()->send();
                    redirect(acte_deces_sign::getUrl());
                })
                ->visible($this->acteDeces->status == 300)
                ->icon('heroicon-o-truck'),

            Action::make('Délivre')
                ->label("Délivré")
                ->color('success')
                ->action(function () {
                    $this->acteDeces->status = 700;
                    $this->acteDeces->save();
                    Notification::make()->title("Demande mise à jour")->info()->send();
                    redirect(acte_deces_livraison::getUrl());
                })
                ->visible($this->acteDeces->status == 600)
                ->icon('heroicon-o-check-circle'),

        Action::make('Refuser')
                ->color('danger')
                ->action(function () {
                    $this->acteDeces->status = 200;
                    $this->acteDeces->save();
                    Notification::make()->title("Demande refusée")->info()->send();
                    redirect(acte_mariage_pending::getUrl());
                })
                ->icon('heroicon-o-x-circle')
        ];
    }
}
