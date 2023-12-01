<x-admin-layout title="Sub Category Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Sub Category List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('sub-categories.index') }}" value="Sub Category List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('sub-categories.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Sub Category
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.sub-category.sub-category-list/>
</x-admin-layout>