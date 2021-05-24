<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Rambo\Resource\Fields\SelectField;
use AngryMoustache\Rambo\Resource\Fields\TextField;

class TitleBlock extends Block
{
    public function fields()
    {
        return [
            SelectField::make('heading')
                ->rules('required')
                ->options([
                    1 => 'H1',
                    2 => 'H2',
                    3 => 'H3',
                    4 => 'H4',
                    5 => 'H5',
                    6 => 'H6',
                ]),

            TextField::make('title')
                ->rules('required'),
        ];
    }
}
