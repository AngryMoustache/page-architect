<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Rambo\Resource\Fields\BooleanField;
use AngryMoustache\Rambo\Resource\Fields\SelectField;
use AngryMoustache\Rambo\Resource\Fields\TextField;

class TitleBlock extends Block
{
    public function fields()
    {
        return [
            SelectField::make('heading')
                ->options([
                    1 => 'H1',
                    2 => 'H2',
                    3 => 'H3',
                    4 => 'H4',
                    5 => 'H5',
                    6 => 'H6',
                ]),

            TextField::make('title'),

            BooleanField::make('highlighted'),
        ];
    }

    public function render()
    {
        return view('page-architect::blocks.title-block', [
            'block' => $this->data,
        ]);
    }
}
