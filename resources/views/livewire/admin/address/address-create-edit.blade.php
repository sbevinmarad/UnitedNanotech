<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
	    <x-admin.form-group >
	        <x-admin.lable value="Title" required />
	        <x-admin.input type="text" wire:model.defer="title" placeholder="Title" />
	        <x-admin.input-error for="title" />
	    </x-admin.form-group>

	    <x-admin.form-group >
	        <x-admin.lable value="Address" required />
	        <x-admin.input type="text" wire:model.defer="address_details" placeholder="Address" />
	        <x-admin.input-error for="address_details" />
	    </x-admin.form-group>

	    <x-admin.form-group >
	        <x-admin.lable value="Opening Hour" required />
	        <x-admin.input type="text" wire:model.defer="opening_hour" placeholder="Opening Hour" />
	        <x-admin.input-error for="opening_hour" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Status" required/>
	        <x-admin.dropdown  wire:model.defer="active" placeHolderText="Please select one" autocomplete="off" >
	                @foreach ($statusList as $status)
	                    <x-admin.dropdown-item  :value="$status['value']" :text="$status['text']"/>                          
	                @endforeach
	        </x-admin.dropdown>
	        <x-admin.input-error for="active" />
	    </x-admin.form-group>

	    

	    

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('addresses.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>