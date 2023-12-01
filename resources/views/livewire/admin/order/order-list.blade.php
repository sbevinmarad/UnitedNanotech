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
        <a href="javascript:void(0)" wire:click=deleteMultiOrder() class="btn btn-brand btn-elevate btn-icon-sm">
            Delete Records
        </a>
    </x-slot>

    <x-slot name="thead">
        <tr role="row">
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 5%;"
                aria-label="Status: activate to sort column ascending"></th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Customer Name
            </th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Customer Phone
            </th>
            
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Order ID
            </th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Order Date
            </th>
            
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Order Status
            </th>
                
            <th class="align-center" rowspan="1" colspan="1" style="width: 15%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th  style="text-align: center"><input type="checkbox" wire:model="all_ids"></th>
            <th colspan="3">
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
        @forelse($orders as $key=>$order)
            <tr role="row" class="odd">
                 <td style="text-align: center"><input type="checkbox" wire:model="deleteIds" value="{{$order->id}}" ></td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>{{ $order->r_order_id }}</td>
                <td>{{ $order->created_at->format('d M, Y') }}</td>
                <td>
                    <select class="form-control form-control-sm form-filter kt-input"
                    title="Select" data-col-index="2" wire:model.defer="status.{{$order->id}}"  wire:change="statusChanged({{$order->id}})">
                        <option value="0">Pending</option>
                        <option value="1">Accepted</option>
                        <option value="2">Delivered</option>
                        <option value="3">Cancelled</option>
                    </select>
                    
                </td>
                <x-admin.td-action>
                <a class="dropdown-item" href="{{ route('orders.show', ['id' => $order->id]) }}"><i
                            class="la la-eye"></i> View</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $order->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="align-center">No records available</td>
            </tr>
        @endforelse

    </x-slot>
    <x-slot name="pagination">
        {{ $orders->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $orders->firstitem() }} to {{ $orders->lastitem() }} of {{ $orders->total() }} entries
    </x-slot>
</x-admin.table>
