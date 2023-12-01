<x-admin-layout title="Completed Order Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Completed Order List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('completed.orders') }}" value="Completed Order List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.order.completed-order/>
</x-admin-layout>