<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Resource\Fields\AttachmentField;
use AngryMoustache\Rambo\Resource\Fields\EditorField;
use AngryMoustache\Rambo\Resource\Fields\SelectField;

class AttachmentTextBlock extends Block
{
    public function fields()
    {
        return [
            SelectField::make('position')
                ->rules('required')
                ->options([
                    'image_left' => 'Image left, text right',
                    'image_right' => 'Image right, text left',
                ]),

            AttachmentField::make('attachment')
                ->rules('required'),

            EditorField::make('text')
                ->rules('required'),
        ];
    }

    public function getData()
    {
        $this->data['attachment'] = Attachment::find($this->data['attachment'] ?? null);
        return $this->data;
    }
}
