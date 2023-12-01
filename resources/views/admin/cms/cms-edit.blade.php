<x-admin-layout title="Cms Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $cms ? 'Edit' : 'Add' }} Cms">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('cms.index') }}" value="Cms List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $cms ? 'Edit' : 'Add' }} Cms" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	@if($cms->slug == 'about-us')
		<livewire:admin.cms.about-us-cms :cms="$cms"/>
	@elseif($cms->slug == 'terms-and-conditions')
		<livewire:admin.cms.contact-us-cms :cms="$cms"/>
	@else
		<livewire:admin.cms.home-cms :cms="$cms"/>
	@endif
</x-admin-layout>