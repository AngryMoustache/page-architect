<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Media\Models\Attachment;
use AngryMoustache\Rambo\Resource\Fields\ManyAttachmentField;
use AngryMoustache\Rambo\Resource\Fields\TabGroup;
use AngryMoustache\Rambo\Resource\Fields\TextField;

class AttachmentsBlock extends Block
{
    public function fields()
    {
        return [
            TabGroup::make()->tabs([
                'general' => 'General',
                'media' => 'Media',
            ])->fields([
                'general' => [
                    TextField::make('text')
                        ->rules('required'),
                    TextField::make('text1')
                        ->rules('required'),
                    TextField::make('text2')
                        ->rules('required'),
                    TextField::make('text3')
                        ->rules('required'),
                ],
                'media' => [
                    ManyAttachmentField::make('attachments')
                        ->rules('required'),
                ]
            ]),

            ManyAttachmentField::make('attachments_1')
                ->rules('required'),
        ];
    }

    public function getData()
    {
        $this->data['attachments'] = Attachment::whereIn('id', $this->data['attachments'] ?? [])->get();
        return $this->data;
    }
}
