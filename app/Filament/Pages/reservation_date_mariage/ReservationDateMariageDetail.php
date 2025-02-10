<?php

namespace App\Filament\Pages\reservation_date_mariage;

use Filament\Pages\Page;

class ReservationDateMariageDetail extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.reservation_date_mariage.reservation-date-mariage-detail';
}
