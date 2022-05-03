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

    <div class="container mx-auto mt-8 border-4" style="max-width: 70rem;">
        <h2 class="text-2xl font-bold">Ma commande</h2>
        <div class="flex w-full gap-4">
            <div class="w-2/3">
                <div class="flex flex-col">
                    <div class="bg-red-300 shadow-lg _overflow-hidden _rounded-lg">
                        <img class="w-24 h-24 border border-red-400"
                            src="https://assets.afcdn.com/recipe/20200605/111747_w1024h1024c1cx2808cy1872.webp" alt="">
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
                        <span>302.99€</span>
                    </div>

                    <h4 class="mt-4 text-lg font-bold">Livraison</h4>
                    <div class="flex flex-col mt-2" style="color: #47484c;">
                        <select
                            class="block w-full p-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            name="shipping_address">
                            <option value="-1">Aucune</option>
                            @foreach ($userShippingAddresses as $address)
                            <option value="{{ $address->getId() }}"></option>
                            @endforeach
                        </select>
                        <a class="mt-2 ml-1 text-xs" href="#!">Ajouter une adresse</a>
                    </div>

                    <h4 class="mt-4 text-lg font-bold">Code Promo</h4>
                    <div class="flex flex-col pb-4 pr-6 mt-2 border-b-2" style="color: #47484c;">
                        <input name="discount_code"
                            class="p-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50" type="text"
                            placeholder="Code de réduction">
                    </div>

                    <div class="flex items-center justify-between mt-4" style="color: #47484c;">
                        <p class="font-semibold">Total:</p>
                        <span class="text-xl font-bold">302.99€</span>
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