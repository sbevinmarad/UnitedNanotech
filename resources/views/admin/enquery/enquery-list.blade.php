<x-admin-layout title="Product Enquery Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Product Enquery List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('enqueires.index') }}" value="Product Enquery List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.enquery.enquery-list/>
</x-admin-layout>