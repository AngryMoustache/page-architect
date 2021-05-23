<?php

namespace AngryMoustache\PageArchitect\Blocks;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Resource\Traits\Fields;

abstract class Block
{
    use Fields;

    public $data = [];

    abstract public function fields();

    abstract public function render();

    public function __construct($data = null)
    {
        $this->data = $data;
        $this->name = $this->getName();
    }

    public function previewRender()
    {
        return $this->render();
    }

    public function getName()
    {
        return $this->name ?? Rambo::getNameFromClassName(get_class($this));
    }
}
