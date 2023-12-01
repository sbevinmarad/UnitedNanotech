<x-admin-layout title="Work Process Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $work_process ? 'Edit' : 'Add' }} Work Process">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('work-processes.index') }}" value="Work Process List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $work_process ? 'Edit' : 'Add' }} Work Process" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.work-process.work-process-create-edit :work_process="$work_process"/>
</x-admin-layout>