<x-admin-layout title="Service Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $service ? 'Edit' : 'Add' }} Service">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('services.index') }}" value="Service List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $service ? 'Edit' : 'Add' }} Service" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.service.service-create-edit :service="$service"/>
</x-admin-layout>