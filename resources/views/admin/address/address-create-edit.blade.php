<x-admin-layout title="Address Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $address ? 'Edit' : 'Add' }} Address">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('addresses.index') }}" value="Address List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $address ? 'Edit' : 'Add' }} Address" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.address.address-create-edit :address="$address"/>
</x-admin-layout>