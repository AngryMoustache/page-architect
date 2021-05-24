<div class="container flex">
    @if ($block['position'] === 'image_left')
        <img class="w-45" src="{{ optional($block['attachment'])->format('thumb') }}">
        <div class="w-5"></div>
    @endif

    <div class="w-50">
        {!! nl2br($block['text'] ?? '') !!}
    </div>

    @if ($block['position'] === 'image_right')
        <div class="w-5"></div>
        <img class="w-45" src="{{ optional($block['attachment'])->format('thumb') }}">
    @endif
</div>
