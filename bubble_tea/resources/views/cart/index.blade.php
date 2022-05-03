<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>

<body class="">

    <div class="container mx-auto mt-8 rounded-md bg-slate-400" style="max-width: 70rem;">
        <h2 class="text-2xl font-bold text-center">Ma commande</h2>
        <div class="flex w-full gap-4">
            <div class="w-2/3">
                <div class="flex flex-col">
                    <div class="bg-red-300 shadow-lg overflow-hidden flex p-1 rounded">
                        <img class="w-24 h-24 border border-red-400 rounded-full"
                            src="https://assets.afcdn.com/recipe/20200605/111747_w1024h1024c1cx2808cy1872.webp" alt="">
                        <div class="flex flex-col justify-center flex-1">
                            <h3 class="text-xl font-bold">Pizza</h3>
                            <p class="text-sm">Pizza Margherita</p>
                            <form action="" method="post" class="text-right  space-x-1.5 flex flex-row-reverse pr-1">
                                @csrf
                                <button><svg class="w-6 h-6" data-darkreader-inline-stroke="" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg></button>

                                <input type="number" name="quantity" value="1" min="1" max="10"
                                    class="rounded-md text-center appearance-none w-8">

                                <button><svg class="w-6 h-6" data-darkreader-inline-stroke="" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg></button>
                                32$
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <form method="POST" action="{{ route('cart.checkout') }}" class="w-1/3 rounded-lg"
                style="background-color: #f2f3f5;">
                @csrf
                <div class="flex flex-col px-4 py-6" style="color: #47484c;">
                    <h3 class="text-xl font-bold">Résumé</h3>
                    <div class="flex items-center justify-between mt-4">
                        <p class="font-semibold">Prix total sans coupon:</p>
                        <span>{{ $order->getTotalPriceWithoutDiscount() }}€</span>
                    </div>

                    <h4 class="mt-4 text-lg font-bold">Livraison</h4>
                    <div class="flex flex-col mt-2" style="color: #47484c;">
                        <select
                            class="block w-full p-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            name="shipping_address">
                            <option value="-1">Aucune</option>
                            @foreach ($userShippingAddresses as $address)
                            <option value="{{ $address->getId() }}">
                                {{ $address->getAddress() }} , {{ $address->getZipCode() }} {{ $address->getCity() }} -
                                {{ $address->getCountry() }}
                            </option>
                            @endforeach
                        </select>
                        <a class="mt-2 ml-1 text-xs" href="{{ route('account.addresses.create') }}">
                            Ajouter une adresse
                        </a>
                    </div>

                    <h4 class="mt-4 text-lg font-bold">Code Promo</h4>
                    <div class="flex flex-col pb-4 pr-6 mt-2 border-b-2" style="color: #47484c;">
                        <input name="discount_code"
                            class="p-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50" type="text"
                            placeholder="Code de réduction">
                    </div>

                    <div class="flex items-center justify-between mt-4" style="color: #47484c;">
                        <p class="font-semibold">Total:</p>
                        <span class="text-xl font-bold">{{ $order->getTotalPrice() }}€</span>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <input type="submit" class="px-4 py-2 font-semibold text-white uppercase rounded"
                            style="background-color: #fe0040;" value="Valider">

                    </div>
                </div>

            </form>
        </div>

    </div>
</body>

</html>