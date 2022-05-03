@props(['image', 'title', /*'description', 'price'*/])

<div>
    <img src="$image" alt="">

    <div class="flex flex-col px-4 py-2">
        <h4>{{ $title }}</h4>
    </div>
</div>