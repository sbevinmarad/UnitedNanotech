<x-admin-layout title="Industry Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $industry ? 'Edit' : 'Add' }} Industry">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('industries.index') }}" value="Industry List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $industry ? 'Edit' : 'Add' }} Industry" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.industry.industry-create-edit :industry="$industry"/>
</x-admin-layout>