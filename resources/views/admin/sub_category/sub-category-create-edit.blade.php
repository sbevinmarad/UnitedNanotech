<x-admin-layout title="Sub Category Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $sub_category ? 'Edit' : 'Add' }} Sub Category">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('sub-categories.index') }}" value="Sub Category List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $sub_category ? 'Edit' : 'Add' }} Sub Category" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.sub-category.sub-category-create-edit :sub_category="$sub_category"/>
</x-admin-layout>