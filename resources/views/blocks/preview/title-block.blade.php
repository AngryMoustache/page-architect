<div class="container">
    <h{{ $block['heading'] ?? '1' }}
        @if ($block['highlighted'] ?? false)
            class="highlight"
        @endif
    >
        {{ $block['title'] ?? '' }}
    </h{{ $block['heading'] ?? '1' }}>
</div>
