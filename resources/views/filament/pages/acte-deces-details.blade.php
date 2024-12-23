<x-filament-panels::page>
    <script defer src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="bg-white rounded p-3 shadow">
    <div class="  p-3 ">
        <fieldset>
            <div class="border-b">Defunt

            </div>
            <div class="grid grid-cols-3 ">
                <div class="my-5">
                    <h5 class="font-semibold">{{ $this->acteDeces->nom_defunt }}</h5>
                    <h6 class="text-gray-600 text-xs">Nom</h6>
                </div>
                <div class="my-5">
                    <h5 class="font-semibold">{{ $this->acteDeces->prenoms_defunt }}</h5>
                    <h6 class="text-gray-600 text-xs">Prénoms</h6>
                </div>
                <div class="my-5">
                    <h5 class="font-semibold">{{ $this->acteDeces->date_naissance_defunt }}</h5>
                    <h6 class="text-gray-600 text-xs">Date naissance</h6>
                </div>
                <div class="my-5">
                    <h5 class="font-semibold">{{ $this->acteDeces->lieu_naissance_defunt }}</h5>
                    <h6 class="text-gray-600 text-xs">Lieu naissance defunt</h6>
                </div>
                <div class="my-5">
                    <h5 class="">
                            
                            <a href="{{ asset('storage/'.$this->acteDeces->pv_deces) }}" class="p-1 rounded-lg border hover:bg-amber-50 font-semisemibold shadow border-amber-700 text-amber-700 bg-white">
                                <span class="fa fa-download"></span>
                                PV de decés
                            </a>
                            
                        
                    </h5>
                </div>
                <div class="my-5">
                    <h5 class="">
                        <a href="{{ asset('storage/'.$this->acteDeces->piece_identite) }}" class="p-1 rounded-lg border hover:bg-amber-50 font-semisemibold shadow border-amber-700 text-amber-700 bg-white">
                            <span class="fa fa-download"></span>
                            Pièce d'identité
                        </a>
                    </h5>
                </div>
            </div>
        </fieldset>
    </div>
    <div class=" p-3">
        <fieldset>
            <div class="border-b">Réquerant</div>
            <div class="grid grid-cols-3 ">
                <div class="my-5">
                    <h5 class="font-semibold">{{ $this->acteDeces->email }}</h5>
                    <h6 class="text-gray-600 text-xs">Email</h6>
                </div>
                <div class="my-5">
                    <h5 class="font-semibold">{{ $this->acteDeces->telephone }}</h5>
                    <h6 class="text-gray-600 text-xs">Téléphone</h6>
                </div>
                <div class="my-5">
                    <h5 class="font-semibold"> {{ $this->acteDeces->numero_piece }}</h5>
                    <h6 class="text-gray-600 text-xs">Numero de la pièce</h6>
                </div>
                <div class="my-5">
                    <h5 class="font-semibold"> {{ $this->acteDeces->type_piece }}</h5>
                    <h6 class="text-gray-600 text-xs">Type de pièce</h6>
                </div>
            </div>
        </fieldset>
    </div>
    <div class=" p-3 ">
        <fieldset>
            <div class="border-b">Informations complémentaire</div>
            <div class="grid grid-cols-3 ">

                <div class="my-5">
                    <h5 class="font-semibold">{{ $this->acteDeces->lieu }}</h5>
                    <h6 class="text-gray-600 text-xs">Lieu</h6>
                </div>
                <div class="my-5">
                    <h5 class="font-semibold"> {{ $this->acteDeces->nb_copie }}</h5>
                    <h6 class="text-gray-600 text-xs">Nombre de copie</h6>
                </div>
                <div class="my-5">
                    <h5 class="font-semibold"> {{ $this->acteDeces->numero_acte }}</h5>
                    <h6 class="text-gray-600 text-xs">Numero acte</h6>
                </div>
                <div class="my-5 col-span-3">
                    <h6 class="text-gray-600 text-xs">Motif</h6>
                    <h5 class="font-semibold">{{ $this->acteDeces->motif }}</h5>
                </div>
            </div>
        </fieldset>
    </div>
</div>
</x-filament-panels::page>
