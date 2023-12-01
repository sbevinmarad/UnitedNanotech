<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group>
	        <x-admin.lable value="Paras Paper And Board House Link" required />
	        <x-admin.input type="url" wire:model.defer="paper_link" placeholder="Paras Paper And Board House Link"  />
	        <x-admin.input-error for="paper_link" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Paras Trade Exim Link" required />
	        <x-admin.input type="url" wire:model.defer="trade_link" placeholder="Paras Trade Exim Link"  />
	        <x-admin.input-error for="trade_link" />
	    </x-admin.form-group>
	  

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('admin.dashboard')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>