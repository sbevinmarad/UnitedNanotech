<x-admin-layout title="Work Process Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Work Process List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('work-processes.index') }}" value="Work Process List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<!-- <a href="{{route('work-processes.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Work Process
					</a> -->
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.work-process.work-process-list/>
</x-admin-layout>