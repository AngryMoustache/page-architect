<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Rambo\Resource\Fields\TextareaField;

class TextBlock extends Block
{
    public $name = 'Text Block';

    public function fields()
    {
        return [
            TextareaField::make('text'),
        ];
    }

    public function render()
    {
        return view('page-architect::blocks.text-block', [
            'block' => $this->data,
        ]);
    }
}
