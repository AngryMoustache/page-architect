<div>
    <link href="{{ asset('vendor/page-architect/css/page-architect.css') }}" rel="stylesheet">

    <a class="button" wire:click.prevent="openPageArchitect">
        Edit content
    </a>

    {{-- Page architect --}}
    @if ($editing)
        <div class="pa">
            <div class="pa-content">
                <div class="pa-content-page">
                    @if (! empty($blockValues) && is_iterable($blockValues))
                        <x-page-architect::add-block-button :index="0" />

                        @foreach ($blockValues as $key => $block)
                            <div class="pa-content-page-block">
                                {{ $block->previewRender() }}

                                <div class="button" wire:click="editBlock({{ $key }})">
                                    Edit
                                </div>

                                <div class="button" wire:click="removeBlock({{ $key }})">
                                    Remove
                                </div>
                            </div>

                            <x-page-architect::add-block-button :index="$key + 1" />
                        @endforeach
                    @else
                        <x-page-architect::add-block-button :index="null" />
                    @endif
                </div>
            </div>

            <div class="pa-tools">
                <h2>Blocks</h2>
                <ul>
                    @foreach ($blockValues as $block)
                        <li>{{ $block->getName() }}</li>
                    @endforeach
                </ul>

                <div class="pa-tools-buttons">
                    <div class="button" wire:click="cancelEdit">
                        Cancel
                    </div>

                    <div class="button" wire:click="savePage">
                        Save
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal --}}
    @if ($modal)
        <div class="pa-modal modal">
            <div class="modal-card w-60 no-padding">
                <div class="modal-card-title">
                    <h4>{{ $modal['title'] }}</h4>
                </div>

                @if ($modal['type'] !== 'deleting')
                    <div class="modal-card-subtitle">
                        <select wire:model="modal.selected">
                            <option value="">-</option>
                            @foreach ($blocks as $block)
                                <option value="{{ get_class($block) }}">
                                    {{ $block->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="modal-card-content-fixed no-padding">
                    @if ($modal['type'] === 'deleting')
                        <table class="crud-show-table">
                            @foreach (optional($modal['block'])->fields() ?? [] as $field)
                                <tr>
                                    <td class="crud-show-table-label">
                                        <span>
                                            {{ $field->getLabel() }}
                                        </span>
                                    </td>

                                    <td class="crud-show-table-value">
                                        <span class="crud-index-table-content">
                                            {{ $field->item($modal['fields'])->renderShow() }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        @if ($modal['selected'] !== '')
                            @foreach($blocks[$modal['selected']]->fields() as $field)
                                {{ $field->item($modal['fields'])->emit('field:pa-update')->render() }}
                            @endforeach
                        @endif
                    @endif
                </div>

                <div class="modal-card-footer">
                    <div class="button" wire:click="saveBlock">
                        {{ $modal['button_text'] }}
                    </div>

                    <a wire:click.prevent="closeModal" class="button-link">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
