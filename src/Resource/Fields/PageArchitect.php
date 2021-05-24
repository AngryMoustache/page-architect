<?php

namespace AngryMoustache\PageArchitect\Resource\Fields;

use AngryMoustache\Rambo\Resource\Fields\Field;

class PageArchitect extends Field
{
    public $component = 'page-architect::fields.form.page-architect';
    public $showComponent = 'page-architect::fields.show.page-architect';

    public function beforeSave($value)
    {
        if (! is_string($value)) {
            return json_encode($value);
        }

        return $value;
    }
}
