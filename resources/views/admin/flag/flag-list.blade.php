<x-admin-layout title="Falg Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Falg List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('flags.index') }}" value="Falg List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('flags.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Falg
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.flag.flag-list/>
</x-admin-layout>