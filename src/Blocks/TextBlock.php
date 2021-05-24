<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Rambo\Resource\Fields\TextareaField;

class TextBlock extends Block
{
    public function fields()
    {
        return [
            TextareaField::make('text')
                ->rules('required'),
        ];
    }

    public function render()
    {
        return view('page-architect::blocks.text-block', [
            'block' => $this->data,
        ]);
    }
}
