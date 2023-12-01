<x-admin-layout title="Blog Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $blog ? 'Edit' : 'Add' }} Blog">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('blogs.index') }}" value="Blog List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $blog ? 'Edit' : 'Add' }} Blog" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.blog.blog-create-edit :blog="$blog"/>
</x-admin-layout>