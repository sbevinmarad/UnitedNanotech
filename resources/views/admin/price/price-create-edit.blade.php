<x-admin-layout title="Price Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $price_plan ? 'Edit' : 'Add' }} Price">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('price-plans.index') }}" value="Price List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $price_plan ? 'Edit' : 'Add' }} Price" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.price.price-create-edit :price_plan="$price_plan"/>
</x-admin-layout>