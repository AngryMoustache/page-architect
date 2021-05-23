<div class="container">
    @foreach ($attachments as $attachment)
        <img
            style="width: 15rem"
            src="{{ optional($attachment)->format('thumb') }}"
        >
    @endforeach
</div>
