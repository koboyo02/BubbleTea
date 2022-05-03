<form method="POST">
    @csrf
    <div class="mb-6">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nom</label>
        <input type="text" id="name" name="name"
            value="{{ old('name', null === $entity->getId() ? '' : $entity->getName()) }}"
            class="bg-gray-100 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300'  }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Nom du produit" required>
        @if ($errors->has('name'))
        <span class="text-sm text-red-500">
            {{ $errors->first('name') }}
        </span>
        @endif
    </div>

    <div class="mb-6">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
        <input type="text" id="description" name="description" placeholder="Description du produit"
            value="{{ old('description', null === $entity->getId() ? '' : $entity->getDescription()) }}"
            class="bg-gray-100 border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300'  }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required>
        @if ($errors->has('description'))
        <span class="text-sm text-red-500">
            {{ $errors->first('description') }}
        </span>
        @endif
    </div>

    <div class="mb-6">
        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Image</label>
        <input type="text" id="image" name="image" placeholder="Url de l'image du produit"
            value="{{ old('image', null === $entity->getId() ? '' : $entity->getImage()) }}"
            class="bg-gray-100 border {{ $errors->has('image') ? 'border-red-500' : 'border-gray-300'  }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required>
        @if ($errors->has('image'))
        <span class="text-sm text-red-500">
            {{ $errors->first('image') }}
        </span>
        @endif
    </div>

    <div class="mb-6">
        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Prix</label>
        <input type="text" id="price" name="price" placeholder="0.00"
            value="{{ old('price', null === $entity->getId() ? '' : $entity->getPrice()) }}"
            class="bg-gray-100 border w-32 {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300'  }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
            required>
        @if ($errors->has('price'))
        <span class="text-sm text-red-500">
            {{ $errors->first('price') }}
        </span>
        @endif
    </div>

    <div class="mb-6">
        <label for="remaining_count" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
        <input type="number" id="remaining_count" min="-1" name="remaining_count"
            value="{{ old('remaining_count',null === $entity->getId() ? '' :  $entity->getRemainingCount()) }}"
            placeholder="-1"
            class="bg-gray-100 border w-32 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
            required>
        @if ($errors->has('remaining_count'))
        <span class="text-sm text-red-500">
            {{ $errors->first('remaining_count') }}
        </span>
        @endif
    </div>
    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Soumettre</button>
</form>