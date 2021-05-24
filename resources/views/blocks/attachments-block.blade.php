<div class="container">
    @foreach ($block['attachments'] ?? [] as $attachment)
        <img
            style="width: 15rem"
            src="{{ optional($attachment)->format('thumb') }}"
        >
    @endforeach
</div>
