<form method="POST">
    @csrf
    <div class="mb-6">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Adresse</label>
        <input type="text" id="address" name="address"
            value="{{ old('address', null === $entity->getId() ? '' : $entity->getAddress()) }}"
            class="bg-gray-100 border {{ $errors->has('address') ? 'border-red-500' : 'border-gray-300'  }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="62 Rue de la Horde" required>
        @if ($errors->has('name'))
        <span class="text-sm text-red-500">
            {{ $errors->first('address') }}
        </span>
        @endif
    </div>

    <div class="mb-6">
        <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Ville</label>
        <input type="text" id="city" name="city" placeholder="Paris"
            value="{{ old('city', null === $entity->getId() ? '' : $entity->getCity()) }}"
            class="bg-gray-100 border w-32 {{ $errors->has('city') ? 'border-red-500' : 'border-gray-300'  }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
            required>
        @if ($errors->has('city'))
        <span class="text-sm text-red-500">
            {{ $errors->first('city') }}
        </span>
        @endif
    </div>

    <div class="mb-6">
        <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900">Code postal</label>
        <input type="text" id="zip_code" name="zip_code" placeholder="94000"
            value="{{ old('zip_code', null === $entity->getId() ? '' : $entity->getZipCode()) }}"
            class="bg-gray-100 border w-32 {{ $errors->has('zip_code') ? 'border-red-500' : 'border-gray-300'  }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
            required>
        @if ($errors->has('zip_code'))
        <span class="text-sm text-red-500">
            {{ $errors->first('zip_code') }}
        </span>
        @endif
    </div>

    <div class="mb-6">
        <label for="country" class="block mb-2 text-sm font-medium text-gray-900">Pays</label>
        <input type="text" id="country" name="country" placeholder="France"
            value="{{ old('country', null === $entity->getId() ? '' : $entity->getCountry()) }}"
            class="bg-gray-100 border w-32 {{ $errors->has('country') ? 'border-red-500' : 'border-gray-300'  }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
            required>
        @if ($errors->has('country'))
        <span class="text-sm text-red-500">
            {{ $errors->first('country') }}
        </span>
        @endif
    </div>

    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Soumettre</button>
</form>