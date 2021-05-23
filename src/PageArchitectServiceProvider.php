<?php

namespace AngryMoustache\PageArchitect;

use AngryMoustache\PageArchitect\Facades\PageArchitect as FacadesPageArchitect;
use AngryMoustache\PageArchitect\Http\Livewire\PageArchitectField;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PageArchitectServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->config();
        $this->livewire();
        $this->publishing();
        $this->views();
    }

    public function register()
    {
        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('PageArchitect', FacadesPageArchitect::class);
        });

        $this->app->alias(PageArchitect::class, 'page-architect');
    }

    private function config()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/page-architect.php', 'page-architect');
    }

    private function livewire()
    {
        Livewire::component('page-architect-field', PageArchitectField::class);
    }

    private function publishing()
    {
        $this->publishes([
            __DIR__ . '/../config/page-architect.php' => config_path('page-architect.php'),
        ], 'page-architect-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/page-architect'),
        ], 'page-architect-views');

        $this->publishes([
            __DIR__ . '/../public/css' => public_path('vendor/page-architect/css'),
        ], 'page-architect-required-assets');
    }

    private function views()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'page-architect');
    }
}
