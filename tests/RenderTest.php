<?php

namespace LasePeCo\Datatables\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LasePeCo\Datatables\Http\Livewire\Datatable;
use LasePeCo\Datatables\Tests\Factories\FakeModelFactory;
use LasePeCo\Datatables\Tests\Models\FakeModel;
use Livewire\Livewire;

class RenderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_columns()
    {
        //<livewire:datatable model="App\Models\User"/>
        factory(FakeModel::class, 5)->create();

        Livewire::test(Datatable::class, ['model' => FakeModel::class])->assertSeeHtmlInOrder([
            'name',
            'email',
        ]);
    }

    /** @test */
    public function it_shows_only_included_columns()
    {
        //<livewire:datatable model="App\Models\User" include="name, email"/>
        //<livewire:datatable model="App\Models\User" include="name,email"/>
        factory(FakeModel::class, 5)->create();

        Livewire::test(Datatable::class, ['model' => FakeModel::class, 'include' => 'name,email'])->assertSeeHtmlInOrder([
            'name',
            'email',
        ])->assertDontSeeText(['id', 'Id', 'ID']);

        Livewire::test(Datatable::class, ['model' => FakeModel::class, 'include' => 'name, email'])->assertSeeHtmlInOrder([
            'name',
            'email',
        ])->assertDontSeeText(['id', 'Id', 'ID']);
    }

    /** @test */
    public function it_shows_all_columns_except_the_excluded()
    {
        //<livewire:datatable model="App\Models\User" exclude="name,id"/>
        factory(FakeModel::class, 5)->create();

        Livewire::test(Datatable::class, ['model' => FakeModel::class, 'exclude' => 'name'])->assertSeeHtmlInOrder([
            'email',
        ])->assertDontSeeText('name');
    }

    /** @test */
    public function it_shows_data()
    {
        $fakeModels = factory(FakeModel::class, 5)->create();

        Livewire::test(Datatable::class, ['model' => FakeModel::class])->assertSeeText($fakeModels->first()->email);
    }

    /** @test */
    public function it_paginates_data()
    {
        $fakeModels = factory(FakeModel::class, 50)->create();

        Livewire::test(Datatable::class, ['model' => FakeModel::class])
            ->set('pagination', 25)
            ->assertSet('pagination', 25)
            ->assertDontSeeText($fakeModels->first()->name);

        Livewire::test(Datatable::class, ['model' => FakeModel::class])
            ->set('pagination', 'All')
            ->assertSet('pagination', 'All')
            ->assertDontSeeText($fakeModels->first()->name);
    }

    /** @test */
    public function it_sorts_data()
    {
        factory(FakeModel::class, 10)->create();

        Livewire::test(Datatable::class, ['model' => FakeModel::class])
            ->call('sort', 'name')
            ->assertSet('sort_by', 'name')
            ->assertSet('sort_direction', 'asc');

        Livewire::test(Datatable::class, ['model' => FakeModel::class])
            ->call('sort', 'id')
            ->assertSet('sort_by', 'id')
            ->assertSet('sort_direction', 'asc');
    }
}
