<x-admin-layout title="Investor Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Investor List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('investors.index') }}" value="Investor List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('investors.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Investor
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.investor.investor-list/>
</x-admin-layout>