<?php

namespace AngryMoustache\PageArchitect;

use AngryMoustache\PageArchitect\Http\Livewire\PageArchitectField;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PageArchitectServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->livewire();
        $this->views();
    }

    private function livewire()
    {
        Livewire::component('page-architect-field', PageArchitectField::class);
    }

    private function views()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'page-architect');
    }
}
