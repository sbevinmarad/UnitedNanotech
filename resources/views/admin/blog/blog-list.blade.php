<x-admin-layout title="Blog Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Blog List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('blogs.index') }}" value="Blog List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('blogs.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Blog
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.blog.blog-list/>
</x-admin-layout>