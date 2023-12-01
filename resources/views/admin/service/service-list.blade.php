<x-admin-layout title="Service Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Service List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('services.index') }}" value="Service List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('services.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Service
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.service.service-list/>
</x-admin-layout>