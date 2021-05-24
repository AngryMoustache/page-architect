<div>
    <link href="{{ asset('vendor/page-architect/css/page-architect.css') }}" rel="stylesheet">

    <a class="button" wire:click.prevent="openPageArchitect">
        Edit content
    </a>

    <a class="button" wire:click.prevent="clearContent">
        Clear content
    </a>

    @if ($value !== $originalValue)
        <br>
        <br>
        <div class="rambo-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <p>
                Warning, you have unsaved changes!<br>
                Remember to save the resource to save your changes.
            </p>
        </div>
    @endif

    {{-- Page architect --}}
    @if ($editing)
        <div class="pa">
            <div class="pa-content-overlay" wire:loading.flex wire:target="savePage">
                <x-rambo::loading />
            </div>

            <div class="pa-content">
                <div class="pa-content-page" wire:sortable="sortBlocks">
                    @if (! empty($blockValues) && is_iterable($blockValues))
                        <x-page-architect::add-block-button :index="0" />
                        @foreach ($blockValues as $key => $block)
                            <div
                                wire:sortable.item="{{ $key }}"
                                wire:key="block-{{ $key }}"
                            >
                                <div class="pa-content-page-block">
                                    <h1 class="pa-content-page-block-name">
                                        {{ $block->getName() }}
                                    </h1>

                                    <div class="pa-content-page-block-preview">
                                        {{ $block->previewRender() }}
                                    </div>

                                    <div class="pa-content-page-block-actions">
                                        <a wire:sortable.handle>
                                            <i class="fas fa-bars"></i>
                                        </a>

                                        <x-page-architect::block-actions :index="$key" />
                                    </div>
                                </div>

                                <x-page-architect::add-block-button :index="$key + 1" />
                            </div>
                        @endforeach
                    @else
                        <x-page-architect::add-block-button :index="null" />
                    @endif
                </div>
            </div>

            <div class="pa-tools">
                <div class="pa-tools-blocklist">
                    <h2>Blocks</h2>
                    <ul wire:sortable="sortBlocks">
                        @foreach ($blockValues as $key => $block)
                            <li wire:sortable.item="{{ $key }}" wire:key="tool-block-{{ $key }}">
                                <span wire:sortable.handle>
                                    <i class="fas fa-bars"></i>
                                    {{ $block->getName() }}
                                </span>

                                <div class="pa-tools-blocklist-actions">
                                    <x-page-architect::block-actions :index="$key" />
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="pa-tools-buttons">
                    <div class="button" wire:click="savePage">
                        Save
                    </div>

                    <div class="button-link" wire:click="cancelEdit">
                        Cancel
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
                            <option value="">- Select a block -</option>
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
                            <div wire:key="{{ $modal['selected'] }}">
                                @foreach($blocks[$modal['selected']]->fields() as $field)
                                    {{
                                        $field
                                            ->item($modal['fields'])
                                            ->emit('field:pa-update')
                                            ->render()
                                    }}
                                @endforeach
                            </div>
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
