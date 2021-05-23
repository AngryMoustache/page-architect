<?php

namespace AngryMoustache\PageArchitect;

use Illuminate\Support\HtmlString;

class PageArchitect
{
    public $blocks;

    public function render($blocks = null)
    {
        $this->blocks ??= $blocks;
        if (is_string($this->blocks)) {
            $this->blocks = json_decode($this->blocks, true);
        }

        $string = '';
        foreach ($this->blocks as $block) {
            $type = $block['type'];
            $data = $block['data'];
            $view = (new $type($data))->render();
            $string .= new HtmlString($view->render());
        }

        return $string;
    }
}
