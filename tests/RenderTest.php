<?php

namespace LasePeCo\Datatables\Tests;

use LasePeCo\Datatables\Http\Livewire\Datatable;
use Livewire\Livewire;

class RenderTest extends TestCase
{
    /** @test */
    public function it_renders_correctly(){
        Livewire::test(Datatable::class)->assertSeeHtml('<table>');
    }
}