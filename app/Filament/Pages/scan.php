<?php

namespace App\Filament\Pages;

use App\Models\ActeDeces;
use App\Services\DocumentUtils;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
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
    public $data = [];
    public $documentClass;

    public function mount()
    {
        $this->documentClass = DocumentUtils::getModelByType(request()->query('type_document'));
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('document')
                ->label("Document")
                ->columnSpan(2)
                ->acceptedFileTypes(['application/pdf','application/docx','application/doc','image/jpeg','image/gif','image/png']),
            TextInput::make('nom'),
            TextInput::make('prenoms')->label("Prénoms"),
            TextInput::make('numero_registre'),
            TextInput::make('date_enregistrement')
                ->label("Date d'enregistrement")
                ->type('date'),
        ])
            ->columns(2)
            ->statePath('data');

    }

    protected function getHeaderActions(): array
    {
        return [
          Action::make('save')
            ->label("Enregistrer les documents")
            ->icon('heroicon-o-check')
            ->color('success')
            ->action(function(){

            })
        ];
    }


}
