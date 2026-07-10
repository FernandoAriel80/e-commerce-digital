@props([
'search' => null,
'url_to',
'back_to',
'placeholder'
])

<div class="search-container">
    <form method="GET" action="{{$url_to }}" class="search-form">
        <input
            type="text"
            name="search"
            placeholder="{{ $placeholder }}"
            value="{{$search}}"
            class="search-input">
        <button type="submit" class="search-btn">Buscar</button>
        @if($search)
        <a href="{{ $back_to }}" class="clear-btn">✖</a>
        @endif
    </form>
</div>