<x-admin-layout title="Investor Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $investor ? 'Edit' : 'Add' }} Investor">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('investors.index') }}" value="Investor List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $investor ? 'Edit' : 'Add' }} Investor" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.investor.investor-create-edit :investor="$investor"/>
</x-admin-layout>