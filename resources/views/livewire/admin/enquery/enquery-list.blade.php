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

    <x-slot name="search">
        
    </x-slot>

    <x-slot name="thead">
        <tr role="row">
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Name
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Email
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Phone
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Product
            </th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                15-sort="ascending" aria-label="Agent: activate to sort column descending">Request Date
            </th>
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th colspan="4">
                <x-admin.input type="search" wire:model.defer="searchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            
            <th colspan="2">
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
        @forelse($enqueries as $enquery)
            <tr role="row" class="odd">
                <td>{{ $enquery->name }}</td>
                <td>{{ $enquery->email }}</td>
                <td>{{ $enquery->phone }}</td>
                <td>{{ $enquery->product_name }}</td>
                <td>{{date('d M, Y', strtotime($enquery->created_at))}} </td>
               
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('enqueires.show', ['id' => $enquery->id]) }}"><i
                            class="la la-eye"></i> View</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $enquery->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="align-center">No records available</td>
            </tr>
        @endforelse

    </x-slot>
    <x-slot name="pagination">
        {{ $enqueries->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $enqueries->firstitem() }} to {{ $enqueries->lastitem() }} of {{ $enqueries->total() }} entries
    </x-slot>
</x-admin.table>
