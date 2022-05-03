<div class="mt-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-md sm:rounded-lg">
            <table class="min-w-full">
                <thead class="bg-white">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-900 uppercase dark:text-gray-400">
                            N° de commande
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-900 uppercase dark:text-gray-400">
                            Montant
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-900 uppercase dark:text-gray-400">
                            Statut
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-900 uppercase dark:text-gray-400">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product->getName() }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $product->getPrice() }}€
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ -1 === $product->getRemainingCount() ? '-': $product->getRemainingCount() }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                            <a href="{{ route('admin.products.edit', $product->getId()) }}"
                                class="text-blue-600 dark:text-blue-500 hover:underline">✒️
                                Editer</a>
                            <a href=" {{ route('admin.products.edit', $product->getId()) }}"
                                class="text-blue-600 dark:text-blue-500 hover:underline">🗑️
                                Supprimer</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>