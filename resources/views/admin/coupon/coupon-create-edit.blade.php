<x-admin-layout title="Coupon Code Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $coupon ? 'Edit' : 'Add' }} Coupon Code">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('coupons.index') }}" value="Coupon Code List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $coupon ? 'Edit' : 'Add' }} Coupon Code" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<livewire:admin.coupon.coupon-create-edit :coupon="$coupon"/>
</x-admin-layout>