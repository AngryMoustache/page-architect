<div class="container">
    <h{{ $block['heading'] }}
        @if ($block['highlighted'])
            class="highlight"
        @endif
    >
        {{ $block['title'] }}
    </h{{ $block['heading'] }}>
</div>
