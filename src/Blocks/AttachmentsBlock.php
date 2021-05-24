<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Resource\Fields\ManyAttachmentField;

class AttachmentsBlock extends Block
{
    public function fields()
    {
        return [
            ManyAttachmentField::make('attachments')
                ->rules('required'),
        ];
    }

    public function getData()
    {
        $this->data['attachments'] = Attachment::whereIn('id', $this->data['attachments'] ?? [])->get();
        return $this->data;
    }
}
