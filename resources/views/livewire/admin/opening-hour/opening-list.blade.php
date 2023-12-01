<x-admin.table>
    {{-- <x-slot name="search">
        <x-admin.input type="search" class="form-control form-control-sm" wire:model.debounce.500ms="search"
            aria-controls="kt_table_1" id="generalSearch" />
    </x-slot> --}}
    <x-slot name="perPage">
        <label>Show
            <x-admin.dropdown wire:model="perPage" class="custom-select custom-select-sm form-control form-control-sm">
                @foreach ($perPageList as $page)
                    <x-admin.dropdown-item :value="$page['value']" :text="$page['text']" />
                @endforeach
            </x-admin.dropdown> entries
        </label>
    </x-slot>

    <x-slot name="thead">
        <tr role="row">
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 60%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Day Time
            </th>
            
            
            <th class="align-center" rowspan="1" colspan="1" style="width: 40%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            
            <th>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-brand kt-btn btn-sm kt-btn--icon" wire:click="search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-secondary kt-btn btn-sm kt-btn--icon" wire:click="resetSearch">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </button>
                    </div>
                </div>
            </th>
        </tr>
    </x-slot>

    <x-slot name="tbody">
        @forelse($opening_hours as $opening_hour)
            <tr role="row" class="odd">
                <td>{{ $opening_hour->day.' '.$opening_hour->time }}</td>
                
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('opening-hours.edit', ['opening_hour' => $opening_hour->id]) }}"><i
                            class="la la-edit"></i> Edit</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $opening_hour->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="align-center">No records available</td>
            </tr>
        @endforelse

    </x-slot>
    <x-slot name="pagination">
        {{ $opening_hours->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $opening_hours->firstitem() }} to {{ $opening_hours->lastitem() }} of {{ $opening_hours->total() }} entries
    </x-slot>
</x-admin.table>