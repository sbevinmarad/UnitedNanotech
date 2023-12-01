<x-admin-layout title="Price Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Price List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('price-plans.index') }}" value="Price List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('price-plans.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Price
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.price.price-list/>
</x-admin-layout>