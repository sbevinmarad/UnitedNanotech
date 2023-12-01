<x-admin-layout title="Order Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Order List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('orders.index') }}" value="Order List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.order.order-list/>
</x-admin-layout>