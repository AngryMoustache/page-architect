<?php

namespace AngryMoustache\PageArchitect\Facades;

use Illuminate\Support\Facades\Facade;

class PageArchitect extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'page-architect';
    }
}
