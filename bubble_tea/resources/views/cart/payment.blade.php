<form action="{{ route('cart.payment') }}" method="POST">
    @csrf
    {{ dump($errors); }}
    <input type="text" name="card_owner_full_name">
    <input type="text" name="card_number">
    <input type="text" name="card_expiration_date">
    <input type="text" name="card_cvv">
    @if ($errors->has('card_owner_full_name'))
    fukc
    @endif

    <input type="submit" value="Pay">
</form>