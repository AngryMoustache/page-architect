<?php

namespace AngryMoustache\PageArchitect\Blocks;

abstract class Block
{
    public $data = [];

    abstract public function fields();

    abstract public function render();

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function previewRender()
    {
        return $this->render();
    }

    public function getName()
    {
        return $this->name;
    }
}
