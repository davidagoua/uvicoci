<x-filament-panels::page>
    <script defer src="https://cdn.tailwindcss.com"></script>
    <div class="bg-white rounded p-3 shadow">
        <div class="p-3">
            <fieldset>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-lg font-medium mb-4">Informations de l'enfant</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="font-medium">Nom de l'enfant:</label>
                                <p>{{ $record->nom_enfant }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Prénoms de l'enfant:</label>
                                <p>{{ $record->prenoms_enfant }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Date de naissance:</label>
                                <p>{{ $record->date_naissance }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Lieu de naissance:</label>
                                <p>{{ $record->lieu_naissance }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium mb-4">Informations des parents</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="font-medium">Nom du père:</label>
                                <p>{{ $record->nom_pere }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Prénoms du père:</label>
                                <p>{{ $record->prenoms_pere }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Nom de la mère:</label>
                                <p>{{ $record->nom_mere }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Prénoms de la mère:</label>
                                <p>{{ $record->prenoms_mere }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium mb-4">Informations de la demande</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="font-medium">Numéro d'acte:</label>
                                <p>{{ $record->numero_acte }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Nombre de copies:</label>
                                <p>{{ $record->nb_copie }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Type de pièce:</label>
                                <p>{{ $record->type_piece }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Motif:</label>
                                <p>{{ $record->motif }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Lieu:</label>
                                <p>{{ $record->lieu }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium mb-4">Contact</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="font-medium">Email:</label>
                                <p>{{ $record->email }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Téléphone:</label>
                                <p>{{ $record->telephone }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Propriétaire:</label>
                                <p>{{ $record->owner ? 'Oui' : 'Non' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-medium mb-4">Documents joints</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @if($certificat_naissance_url)
                            <div>
                                <label class="font-medium block mb-2">Certificat de naissance:</label>
                                <a href="{{ $certificat_naissance_url }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                    Voir le document
                                </a>
                            </div>
                        @endif

                        @if($piece_identite_pere_url)
                            <div>
                                <label class="font-medium block mb-2">Pièce d'identité du père:</label>
                                <a href="{{ $piece_identite_pere_url }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                    Voir le document
                                </a>
                            </div>
                        @endif

                        @if($piece_identite_mere_url)
                            <div>
                                <label class="font-medium block mb-2">Pièce d'identité de la mère:</label>
                                <a href="{{ $piece_identite_mere_url }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                    Voir le document
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</x-filament-panels::page>
