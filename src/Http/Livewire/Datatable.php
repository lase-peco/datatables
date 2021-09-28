<?php

namespace LasePeCo\Datatables\Http\Livewire;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Arr;
use LasePeCo\Datatables\Tests\Models\FakeModel;
use Livewire\Component;

class Datatable extends Component
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    private $model;

    public function mount($model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function query()
    {
        return new $this->model;
    }

    public function render()
    {
        return view('datatables::livewire.datatable')->with([
            'columns' => $this->getColumns(),
        ]);
    }

    private function getColumns()
    {
        return collect($this->query()->first()->getAttributes())->keys()->map(fn($key) => ucfirst($key))->toArray();
    }
}
