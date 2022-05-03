<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Mes adresses') }}
            </h2>

            <a href="{{ route('account.addresses.create') }}">Ajouter</a>
        </div>
    </x-slot>
    <div class="container mx-auto mt-12" style="max-width: 66rem;">

        @if (0 < count($addresses)) <div class="flex flex-col gap-6 md:grid md:grid-cols-2">
            @foreach ($addresses as $address)
            <a href="{{ route('account.addresses.edit', ['id' => $address->getId()]) }}">
                <div class="relative p-6 bg-white border-2 rounded-md roundred-md hover:border-blue-400">
                    <p class="text-sm text-gray-600">
                        <span class="font-bold">Suite:</span> {{ $address->getAddress() }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-bold">Code postal:</span> {{ $address->getZipCode() }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-bold">Ville:</span> {{ $address->getCity() }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-bold">Pays:</span> {{ $address->getCountry() }}
                    </p>

                    <span class="absolute top-0 right-0 mt-6 mr-6 text-xs">
                        <form action="{{ route('account.addresses.delete', ['id' => $address->getId()]) }}">
                            @csrf
                            <input type="submit" class="text-gray-600 hover:text-gray-900" value="Supprimer">
                        </form>
                    </span>
                </div>
            </a>
            @endforeach
    </div>
    @else
    <div class="flex flex-col gap-6 md:grid md:grid-cols-2">
        <div class="p-6 bg-white border-2 rounded-md roundred-md hover:border-blue-400">
            <p class="text-sm text-gray-600">
                <span class="font-bold">Aucune adresse</span>
            </p>
        </div>
    </div>
    @endif

    </div>
</x-app-layout>