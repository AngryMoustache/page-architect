<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Rambo\Resource\Fields\EditorField;

class TextBlock extends Block
{
    public function fields()
    {
        return [
            EditorField::make('text')
                ->rules('required'),
        ];
    }
}
