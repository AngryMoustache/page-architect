<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Resource\Fields\AttachmentField;

class AttachmentBlock extends Block
{
    public $name = 'Attachment Block';

    public function fields()
    {
        return [
            AttachmentField::make('attachment'),
        ];
    }

    public function render()
    {
        return view('page-architect::blocks.attachment-block', [
            'attachment' => Attachment::find($this->data['attachment']),
        ]);
    }
}
