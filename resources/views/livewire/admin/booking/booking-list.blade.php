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
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 18%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">User Name
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 18%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Service Name
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 12%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Booking Date
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 12%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">From Zip
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 12%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">To Zip
            </th>
            
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 12%;"
                aria-label="Status: activate to sort column ascending">Status
            </th>

            <th class="align-center" rowspan="1" colspan="1" style="width: 16%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchServiceName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="date" wire:model.defer="searchDate" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchFromZip" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchToZip" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="0">Pending</option>
                    <option value="1">Accepted</option>
                    <option value="2">Rejected</option>
                </select>
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
        @forelse($bookings as $booking)
            <tr role="row" class="odd">
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->service?$booking->service->name:'' }}</td>
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->from_zip }}</td>
                <td>{{ $booking->to_zip }}</td>
                <td class="align-center">
                	@php
                	if($booking->active == 2){
                		$color = 'danger';	
                		$active = 'Rejected';
                	}
            		elseif($booking->active == 1){
            			$color = 'success';
                		$active = 'Accepted';
            		}
            		else{
            			$color = 'warning';
                		$active = 'Pending';
            		}
                	@endphp
                	<span class="kt-badge  kt-badge--{{$color}} kt-badge--inline kt-badge--pill"
                        >{{ $active }}
                    </span>
                </td>
                <td>
                   @if($booking->active == '0')
                    <select class="form-control form-control-sm form-filter kt-input"
                    title="Select" data-col-index="2" wire:model.defer="active"  wire:change="statusChanged({{$booking->id}})">
	                    <option value="0">Pending</option>
	                    <option value="1">Accepted</option>
	                    <option value="2">Rejected</option>
	                </select>
	                @elseif($booking->active == '1')
                		Accepted
                	@elseif($booking->active == '2')
                		Rejected
                	@endif 
                    <a class="dropdown-item" href="{{ route('bookings.show',$booking->id) }}"><i
                            class="la la-eye"></i> View</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="align-center">No records available</td>
            </tr>
        @endforelse

    </x-slot>
    <x-slot name="pagination">
        {{ $bookings->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $bookings->firstitem() }} to {{ $bookings->lastitem() }} of {{ $bookings->total() }} entries
    </x-slot>
</x-admin.table>
