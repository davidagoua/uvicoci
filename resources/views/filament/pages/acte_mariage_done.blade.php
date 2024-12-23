<x-filament-panels::page>
    <div class="space-y-6">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <x-filament::card>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-medium">Total en attente</h2>
                        <p class="text-3xl font-semibold">{{ \App\Models\ActeMariage::where('status', 0)->count() }}</p>
                    </div>
                    <div class="p-3 bg-primary-100 rounded-full">
                        <x-heroicon-o-clock class="w-6 h-6 text-primary-500"/>
                    </div>
                </div>
            </x-filament::card>

            <x-filament::card>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-medium">Approuvés</h2>
                        <p class="text-3xl font-semibold">{{ \App\Models\ActeMariage::where('status', 100)->count() }}</p>
                    </div>
                    <div class="p-3 bg-success-100 rounded-full">
                        <x-heroicon-o-check-circle class="w-6 h-6 text-success-500"/>
                    </div>
                </div>
            </x-filament::card>

            <x-filament::card>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-medium">Rejetés</h2>
                        <p class="text-3xl font-semibold">{{ \App\Models\ActeMariage::where('status', 200)->count() }}</p>
                    </div>
                    <div class="p-3 bg-danger-100 rounded-full">
                        <x-heroicon-o-x-circle class="w-6 h-6 text-danger-500"/>
                    </div>
                </div>
            </x-filament::card>
        </div>

        <div>
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>