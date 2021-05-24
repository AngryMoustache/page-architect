<?php

namespace AngryMoustache\PageArchitect\Http\Livewire;

use AngryMoustache\Rambo\Http\Livewire\Fields\LivewireField;

class PageArchitectField extends LivewireField
{
    public $editing = false;
    public $modal = null;
    public $blocks = null;
    public $fields = null;
    public $rules = [];
    public $originalValue = null;

    protected $listeners = [
        'field:pa-update' => 'updateField',
    ];

    public function mount($field, $emit = null, $clearOnUpdate = null)
    {
        parent::mount($field, $emit, $clearOnUpdate);

        $this->value ??= [];
        if (is_string($this->value)) {
            $this->value = json_decode($this->value, true) ?? [];
        }

        $this->getBlocks()->each(fn ($block, $key) =>
            $this->rules[$key] = $block->validationFieldStack()
        );

        $this->originalValue = $this->value;
    }

    public function render()
    {
        $this->blocks = $this->getBlocks()->toArray();

        $blockValues = collect($this->value)
            ->filter(fn ($block) => class_exists($block['type']))
            ->map(fn ($block) => (new $block['type']($block['data'])));

        return view('page-architect::livewire.fields.page-architect-field', [
            'blockValues' => $blockValues,
        ]);
    }

    public function updateField($value, $fieldName)
    {
        $this->fields[$fieldName] = $value;
    }

    public function updatedModal()
    {
        $this->fields = [];
    }

    public function openPageArchitect()
    {
        $this->editing = true;
    }

    public function addNewBlock($index = null)
    {
        $this->fields = [];
        $this->modal = [
            'title' => 'Add a new block',
            'button_text' => 'Add block',
            'index' => $index,
            'type' => 'creating',
            'selected' => '',
            'fields' => [],
        ];
    }

    public function editBlock($index)
    {
        $block = $this->value[$index];
        $this->fields = $block['data'];
        $this->modal = [
            'title' => 'Edit block',
            'button_text' => 'Update block',
            'index' => $index,
            'type' => 'editing',
            'selected' => $block['type'],
            'fields' => $block['data'],
        ];
    }

    public function removeBlock($index)
    {
        $block = $this->value[$index];
        $this->fields = $block['data'];
        $this->modal = [
            'title' => 'Are you sure you want to remove this block?',
            'button_text' => 'Delete block',
            'index' => $index,
            'type' => 'deleting',
            'fields' => $block['data'],
            'block' => (new $block['type']($block['data'])),
        ];
    }

    public function closeModal()
    {
        $this->modal = null;
    }

    public function saveBlock()
    {
        $this->modal['fields'] = $this->fields;
        $index = $this->modal['index'];
        $block = [
            'type' => $this->modal['selected'] ?? null,
            'data' => $this->modal['fields'] ?? [],
        ];

        // Inserting/updating
        if (in_array($this->modal['type'], ['creating', 'editing'])) {
            if (empty($this->modal['selected'])) {
                return;
            }

            $rules = $this->rules[$this->modal['selected']] ?? [];
            if (! empty($rules)) {
                $this->validate($rules);
            }
        }

        // Insert new block
        if ($this->modal['type'] === 'creating') {
            if ($index === null) {
                $this->value[] = $block;
            } elseif ($index === 0) {
                array_unshift($this->value, $block);
            } else {
                $newValue = array_slice($this->value, 0, $index);
                $newValue[] = $block;
                $newValue = array_merge(
                    $newValue,
                    array_slice($this->value, $index, count($this->value) - 1)
                );

                $this->value = $newValue;
            }
        // Update existing block
        } elseif ($this->modal['type'] === 'editing') {
            $this->value[$this->modal['index']] = $block;
        // Remove block
        } elseif ($this->modal['type'] === 'deleting') {
            unset($this->value[$this->modal['index']]);
        }

        $this->closeModal();
    }

    public function savePage()
    {
        $this->editing = false;
        $this->emitValue($this->value);
    }

    public function sortBlocks($blocks)
    {
        $value = $this->value;
        $this->value = [];

        foreach ($blocks as $block) {
            $this->value[] = $value[$block['value']];
        }
    }

    public function cancelEdit()
    {
        $this->value = $this->originalValue;
        $this->editing = false;
    }

    public function clearContent()
    {
        $this->value = [];
    }

    private function getBlocks()
    {
        return collect(config('page-architect.blocks', []))
            ->mapWithKeys(fn ($block) => [$block => (new $block())]);
    }
}
