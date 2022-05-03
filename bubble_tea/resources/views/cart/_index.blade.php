<p>Add products</p>
@foreach ($products as $p)
<div>
    <form action="{{ route('cart.add_item', ['productId' => $p->getId() ]) }}" method="post">
        @csrf
        <p>{{ $p->getName() }}</p>
        <input type="number" name="quantity" value="1">
        <input type="submit" value="Ajouter">
    </form>
</div>
@endforeach
<hr>
<p>Remove order's item</p>
@foreach ($order->getItems() as $item)
<div>
    <form action="{{ route('cart.remove_item', ['orderItemId' => $item->getId() ]) }}" method="post">
        @csrf
        <p>{{ $item->getProduct()->getName() }}</p>
        <p>Supplements: </p>
        @foreach ($item->getSupplements() as $supplement)
        {{ $supplement->getName() }},
        @endforeach
        <input type="submit" value="Remove">
    </form>
    <hr>
    <form action="{{ route('cart.set_item_quantity', ['orderItemId' => $item->getId() ]) }}" method="post">
        @csrf
        <p>{{ $item->getProduct()->getName() }}</p>
        <p>Supplements:</p>
        @foreach ($item->getSupplements() as $supplement)
        {{ $supplement->getName() }},
        @endforeach
        <input type="number" name="quantity" value="1">
        <input type="submit" value="Set to n">
    </form>
</div>
@endforeach
<hr>
<p>set address</p>
<br>
@if (0 >= count($userShippingAddresses))
<a class="px-4 py-2 font-semibold text-white bg-indigo-500" href="#!">Ajouter une adresse</a>
@else
<select name="shipping_adress">
    <option value="-1">Aucune</option>
    @foreach ($userShippingAddresses as $address)
    <option value="{{ $address->getId() }}"></option>
    @endforeach
</select>
@endif
<hr>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">

{{-- {!! form($form) !!} --}}
<hr>

<div class="bg-gray-100">

    <div class="container py-8 mx-auto " style="max-width: 70rem;">
        <div class="grid grid-cols-3 gap-4">

            <product-card title="test"
                image="https://assets.afcdn.com/recipe/20200605/111747_w1024h1024c1cx2808cy1872.webp">
            </product-card>

            <product-card title="test"
                image="https://assets.afcdn.com/recipe/20200605/111747_w1024h1024c1cx2808cy1872.webp">
            </product-card>

            <product-card title="test"
                image="https://assets.afcdn.com/recipe/20200605/111747_w1024h1024c1cx2808cy1872.webp">
            </product-card>
        </div>

        <modax-box>

            <h1>Test</h1>
        </modax-box>
    </div>



</div>


<script src="/a.js"></script>