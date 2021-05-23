<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Rambo\Resource\Fields\SelectField;

class SpacerBlock extends Block
{
    public $name = 'Spacer';

    public function fields()
    {
        return [
            SelectField::make('size')
                ->rules('required')
                ->options([
                    5 => 'Small',
                    10 => 'Medium',
                    15 => 'Large',
                ]),
        ];
    }

    public function render()
    {
        return view('page-architect::blocks.spacer-block', [
            'block' => $this->data,
        ]);
    }
}
