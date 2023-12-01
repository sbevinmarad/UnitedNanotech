<x-admin-layout title="Flag Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $flag ? 'Edit' : 'Add' }} Flag">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('flags.index') }}" value="Flag List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $flag ? 'Edit' : 'Add' }} Flag" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.flag.flag-create-edit :flag="$flag"/>
</x-admin-layout>