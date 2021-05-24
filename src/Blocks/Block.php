<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Resource\Traits\Fields;
use Illuminate\Support\Str;

abstract class Block
{
    use Fields;

    public $data = [];
    public $blockComponent = null;
    public $blockPreviewComponent = null;

    abstract public function fields();

    public function __construct($data = null)
    {
        $this->data = $data;
        $this->name = $this->getName();
        $this->blockComponent ??= Str::kebab($this->getName());
        $this->blockPreviewComponent ??= $this->blockComponent;
    }

    public function render()
    {
        return view("page-architect::blocks.{$this->blockComponent}", [
            'block' => $this->getData(),
        ]);
    }

    public function previewRender()
    {
        return view("page-architect::blocks.preview.{$this->blockPreviewComponent}", [
            'block' => $this->getData(),
        ]);
    }

    public function getName()
    {
        return $this->name ?? Rambo::getNameFromClassName(get_class($this));
    }

    public function getData()
    {
        return $this->data;
    }
}
