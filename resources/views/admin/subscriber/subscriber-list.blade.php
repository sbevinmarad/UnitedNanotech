<x-admin-layout title="Subscriber Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Subscriber List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('subscribers.index') }}" value="Subscriber List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<livewire:admin.subscriber.subscriber-list/>
</x-admin-layout>