<a wire:click="editBlock({{ $index }})">
    <i class="fas fa-pencil-alt"></i>
</a>

<a wire:click="removeBlock({{ $index }})">
    <i class="fas fa-trash-alt"></i>
</a>

<a wire:click="addNewBlock({{ $index + 1 }})">
    <i class="fas fa-plus"></i>
</a>
