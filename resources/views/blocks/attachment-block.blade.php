<div class="container">
    @foreach ($attachments as $attachment)
        <img src="{{ optional($attachment)->format('thumb') }}">
    @endforeach
</div>
