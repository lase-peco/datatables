<?php

namespace LasePeCo\Datatables\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    /**
     * @var string
     */
    public $include;

    /**
     * @var string
     */
    public $exclude;

    /**
     * @var string
     */
    public $sort_by;

    /**
     * @var string
     */
    public $sort_direction;


    public $pagination;

    public function mount($model, $include = null, $exclude = null, $pagination = 10)
    {
        $this->model = $model;
        $this->include = collect(explode(',', $include))->map(fn($key) => trim($key))->filter()->unique()->toArray();
        $this->exclude = collect(explode(',', $exclude))->map(fn($key) => trim($key))->filter()->unique()->toArray();
        $this->pagination = $pagination;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function query()
    {

        return new $this->model;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $columns = $this->getColumns();

        $data = $this->query();

        if (is_null($this->sort_by)) {
            $this->sort_by = array_key_first($columns);
            $this->sort_direction = 'desc';
        }

        $data = $data->orderBy($this->sort_by, $this->sort_direction);

        if ($this->pagination == "All"){
            $data=  $data->paginate();
        }else{
            $data=  $data->paginate($this->pagination);
        }

        return view('datatables::livewire.datatable', compact('columns', 'data'));
    }

    /**
     * @return array
     */
    private function getColumns(): array
    {
        $columns = collect($this->query()->first()->getAttributes());

        if (count($this->exclude) > 0) {
            $columns = $columns->except($this->exclude);
        }

        if (count($this->include) > 0) {
            $sortedColumns = collect();

            foreach ($this->include as $key) {
                $sortedColumns[$key] = $columns[$key];
            }

            $columns = $sortedColumns;
        }

        return $columns->map(fn($value, $key) => $key)->toArray();
    }

    /**
     * @param $attribute
     */
    public function sort($attribute)
    {
        if ($this->sort_by != $attribute) {
            $this->sort_direction = 'asc';
        } else {
            $this->sort_direction = $this->sort_direction == 'asc' ? 'desc' : 'asc';
        }

        $this->sort_by = $attribute;
    }
}
