<?php

namespace LasePeCo\Datatables;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LasePeCo\Datatables\Http\Livewire\Datatable;
use Livewire\Livewire;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'datatables');

        Livewire::component('datatable', Datatable::class);
    }
}