<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Testing\Fluent\Concerns\Interaction;

class scan extends Page implements HasForms
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $title = "Scanner des documents";
    protected static string $view = 'filament.pages.scan';

    use InteractsWithForms;
    public $documents = [];

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('ActeDeces')
                ->multiple()
                ->label("Acte de décès")
                ->acceptedFileTypes(['application/pdf','application/docx','application/doc','image/jpeg','image/gif','image/png']),
            FileUpload::make('DeclarationNaissance')
                ->label("Déclaration naissance")
                ->multiple()
                ->acceptedFileTypes(['application/pdf','application/docx','application/doc','image/jpeg','image/gif','image/png']),
            FileUpload::make('CopieIntegrale')
                ->multiple()
                ->label("Copie Intégrale d'acte de naissance")
                ->acceptedFileTypes(['application/pdf','application/docx','application/doc','image/jpeg','image/gif','image/png']),
            FileUpload::make('ActeMariage')
                ->label("Acte de Mariage")
                ->multiple()
                ->acceptedFileTypes(['application/pdf','application/docx','application/doc','image/jpeg','image/gif','image/png']),
            FileUpload::make('DateMariage')
                ->label("Reservation date de mariage")
                ->multiple()
                ->acceptedFileTypes(['application/pdf','application/docx','application/doc','image/jpeg','image/gif','image/png']),
        ])

            ;
    }


}
