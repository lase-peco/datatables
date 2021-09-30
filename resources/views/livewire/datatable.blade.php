<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        @foreach($columns as $column)
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer align-middle whitespace-nowrap"
                                wire:click="sort('{{$column}}')">
                                @if($this->sort_by == $column)
                                    @if($this->sort_direction == 'desc')
                                        {{-- https://fontawesome.com/v5.15/icons/sort-up?style=solid--}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="inline-block w-2 fill-current text-gray-500">
                                            <path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41z"/>
                                        </svg>
                                    @else
                                        {{-- https://fontawesome.com/v5.15/icons/sort-down?style=solid--}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="inline-block w-2 fill-current text-gray-500">
                                            <path d="M279 224H41c-21.4 0-32.1-25.9-17-41L143 64c9.4-9.4 24.6-9.4 33.9 0l119 119c15.2 15.1 4.5 41-16.9 41z"/>
                                        </svg>
                                    @endif
                                @else
                                    {{--https://fontawesome.com/v5.15/icons/sort?style=solid--}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="inline-block w-2 fill-current text-gray-500">
                                        <path
                                            d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/>
                                    </svg>
                                @endif
                                {{ str_replace('_', ' ', $column) }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr class="odd:bg-white even:bg-gray-50">
                            @foreach($columns as $key => $column)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $row->{$key} }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-2 px-4 flex content-center">
                    <div class="mr-2">
                        <select  wire:model="pagination" id="pagination" name="pagination" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            @foreach([10,25,50,100,'All'] as $count)
                                <option value="{{$count}}">{{$count}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="w-full">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
