<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>

<body class="bg-pink-200">
    @include('../header')
    <div class="bg-white mt-6 pt-8 pb-4 pl-9 pr-9 mx-40 rounded-lg">

        <form method="POST" action="{{ url('admin') }}">
            {{-- @csrf --}}
            {{ csrf_field() }}
            
            <!-- FirstName -->
            <div>
                <x-label class="ml-5" for="name" :value="__('Nom du produit')" />

                <x-input id="name" class="block mt-1 w-full rounded-lg border-2" type="text" name="name"
                    :value="old('name')" required autofocus />
            </div>

            <!-- LastName -->
            <div class="mt-4">
                <x-label class="ml-5" for="description" :value="__('Description')" />

                <x-input id="description" class="block mt-1 w-full rounded-lg border-2" type="text" name="description"
                    :value="old('description')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label class="ml-5" for="image" :value="__('Image')" />

                <x-input id="image" class="block mt-1 w-full rounded-lg border-2" type="text" name="image"
                    :value="old('image')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label class="ml-5" for="price" :value="__('Prix')" />

                <x-input id="price" class="block mt-1 w-full rounded-lg border-2" type="n" name="price" required
                    autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-8">
                <x-button class="ml-4 bg-black">
                    {{ __('Ajouter') }}
                </x-button>
            </div>
        </form>
    </div>
</body>

</html>
