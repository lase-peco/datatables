<?php

namespace LasePeCo\Datatables\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;
use LasePeCo\Datatables\Http\Livewire\Datatable;
use LasePeCo\Datatables\Tests\Factories\FakeModelFactory;
use LasePeCo\Datatables\Tests\Models\FakeModel;
use Livewire\Livewire;

class RenderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_columns(){
        //<livewire:datatable model="App\Models\User" />

        factory(FakeModel::class, 5)->create();

        Livewire::test(Datatable::class ,  ['model' => FakeModel::class])->assertSeeHtmlInOrder([
            '<td>Name</td>',
            '<td>Email</td>',
        ]);
    }
}
