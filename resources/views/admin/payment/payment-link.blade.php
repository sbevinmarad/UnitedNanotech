<x-admin-layout title="Payment Link Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Edit Payment Link">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Edit Payment Link" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.payment.payment-link />
</x-admin-layout>