<x-admin-layout title="Address Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Address List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('addresses.index') }}" value="Address List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('addresses.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Address
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.address.address-list/>
</x-admin-layout>