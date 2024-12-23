<x-filament-panels::page>
    <script defer src="https://cdn.tailwindcss.com"></script>
    <div class="bg-white rounded p-3 shadow">
        <div class="p-3">
            <fieldset>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium mb-6">Informations de l'enfant</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-500">Nom de l'enfant:</label>
                                <p class="font-bold mt-1">{{ $record->nom_enfant }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Prénoms de l'enfant:</label>
                                <p class="font-bold mt-1">{{ $record->prenoms_enfant }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Date de naissance:</label>
                                <p class="font-bold mt-1">{{ $record->date_naissance }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Lieu de naissance:</label>
                                <p class="font-bold mt-1">{{ $record->lieu_naissance }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-lg font-medium mb-6">Informations des parents</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-500">Nom du père:</label>
                                <p class="font-bold mt-1">{{ $record->nom_pere }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Prénoms du père:</label>
                                <p class="font-bold mt-1">{{ $record->prenoms_pere }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Nom de la mère:</label>
                                <p class="font-bold mt-1">{{ $record->nom_mere }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Prénoms de la mère:</label>
                                <p class="font-bold mt-1">{{ $record->prenoms_mere }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-lg font-medium mb-6">Informations de la demande</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-500">Numéro d'acte:</label>
                                <p class="font-bold mt-1">{{ $record->numero_acte }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Nombre de copies:</label>
                                <p class="font-bold mt-1">{{ $record->nb_copie }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Type de pièce:</label>
                                <p class="font-bold mt-1">{{ $record->type_piece }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Motif:</label>
                                <p class="font-bold mt-1">{{ $record->motif }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Lieu:</label>
                                <p class="font-bold mt-1">{{ $record->lieu }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-lg font-medium mb-6">Contact</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-gray-500">Email:</label>
                                <p class="font-bold mt-1">{{ $record->email }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Téléphone:</label>
                                <p class="font-bold mt-1">{{ $record->telephone }}</p>
                            </div>
                            <div>
                                <label class="text-gray-500">Propriétaire:</label>
                                <p class="font-bold mt-1">{{ $record->owner ? 'Oui' : 'Non' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <h3 class="text-lg font-medium mb-6">Documents joints</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($certificat_naissance_url)
                            <div>
                                <label class="text-gray-500 block mb-2">Certificat de naissance:</label>
                                <a href="{{ $certificat_naissance_url }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                    Voir le document
                                </a>
                            </div>
                        @endif

                        @if($piece_identite_pere_url)
                            <div>
                                <label class="text-gray-500 block mb-2">Pièce d'identité du père:</label>
                                <a href="{{ $piece_identite_pere_url }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                    Voir le document
                                </a>
                            </div>
                        @endif

                        @if($piece_identite_mere_url)
                            <div>
                                <label class="text-gray-500 block mb-2">Pièce d'identité de la mère:</label>
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
