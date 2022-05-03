<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mon compte') }}
        </h2>
    </x-slot>
    <div class="container mx-auto mt-12 border-2" style="max-width: 66rem;">
        <h2 class="text-xl font-semibold">Vos informations</h2>
        <div class="flex flex-col gap-4 mt-2 mb-8 md:grid md:grid-cols-3">
            <div class="flex flex-col px-6 py-5 bg-white rounded-md shadow-md">
                <div class="flex items-center">
                    <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#fff" fill-opacity=".01" d="M0 0h48v48H0z" />
                        <path d="M44 44V20L24 4 4 20v24h12V26h16v18h12Z" stroke="#333" stroke-width="4"
                            stroke-linejoin="round" />
                        <path d="M24 44V34" stroke="#333" stroke-width="4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold text-gray-700">Mes adresses</span>
                        <span>test</span>
                    </div>
                </div>
                <div class="">
                    <a href="{{ route('account.addresses.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Voir mes adresses
                    </a>
                </div>
            </div>
            <div class="flex flex-col px-6 py-5 bg-white rounded-md shadow-md">
                <div class="flex items-center">
                    <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#fff" fill-opacity=".01" d="M0 0h48v48H0z" />
                        <path d="M44 44V20L24 4 4 20v24h12V26h16v18h12Z" stroke="#333" stroke-width="4"
                            stroke-linejoin="round" />
                        <path d="M24 44V34" stroke="#333" stroke-width="4" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold text-gray-700">Mes adresses</span>
                        <span>test</span>
                    </div>
                </div>
                <div class="">
                    <a href="{{ '' ?? route('account.address.index') }}"
                        class="text-sm text-gray-600 hover:text-gray-900">
                        Changer mes données
                    </a>
                </div>
            </div>
        </div>

        <h2 class="text-xl font-semibold">Activités récentes</h2>
        @include('account._activivity_table')

    </div>
</x-app-layout>