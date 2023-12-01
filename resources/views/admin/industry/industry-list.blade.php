<x-admin-layout title="Industry Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Industry List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('industries.index') }}" value="Industry List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('industries.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Industry
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.industry.industry-list/>
</x-admin-layout>