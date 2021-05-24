<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Resource\Fields\ManyAttachmentField;

class AttachmentBlock extends Block
{
    public function fields()
    {
        return [
            ManyAttachmentField::make('attachments')
                ->rules('required'),
        ];
    }

    public function render()
    {
        return view('page-architect::blocks.attachment-block', [
            'attachments' => Attachment::whereIn('id', $this->data['attachments'] ?? [])->get(),
        ]);
    }
}
