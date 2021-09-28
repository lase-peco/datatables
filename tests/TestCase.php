<?php

namespace LasePeCo\Datatables\Tests;


class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Livewire\LivewireServiceProvider::class,
            \LasePeCo\Datatables\ServiceProvider::class
        ];
    }
}