<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">

    	<x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Email ID" required />
	        <x-admin.input type="text" wire:model.defer="email" placeholder="Email ID"  />
	        <x-admin.input-error for="email" />
	    </x-admin.form-group>

	    

	    <x-admin.form-group>
	        <x-admin.lable value="Phone Number" required />
	        <x-admin.input type="text" wire:model.defer="phone" placeholder="Phone Number" onkeypress="return number_check(this,event);"  />
	        <x-admin.input-error for="phone" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Phone Number 2" required />
	        <x-admin.input type="text" wire:model.defer="phone_2" placeholder="Phone Number 2" onkeypress="return number_check(this,event);"  />
	        <x-admin.input-error for="phone_2" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Google Recaptcha Key" required/>
	        <x-admin.input type="text" wire:model.defer="google_recaptcha_key" placeholder="Google Recaptcha Key" />
	        <x-admin.input-error for="google_recaptcha_key" />
	    </x-admin.form-group>

		<x-admin.form-group>
	        <x-admin.lable value="Google Recaptcha Secret" required/>
	        <x-admin.input type="text" wire:model.defer="google_recaptcha_secret" placeholder="Google Recaptcha Secret" />
	        <x-admin.input-error for="google_recaptcha_secret" />
	    </x-admin.form-group>
	    
    	
        <x-admin.form-group>
	        <x-admin.lable value="Address" required />
	        <x-admin.textarea type="text" rows="5" wire:model.defer="address" placeholder="Address"  />
	        <x-admin.input-error for="address" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Factory Address" required />
	        <x-admin.textarea type="text" rows="5" wire:model.defer="address_2" placeholder="Factory Address"  />
	        <x-admin.input-error for="address_2" />
	    </x-admin.form-group>

	    <x-admin.form-group >
	        <x-admin.lable value="Map" required />
	        <x-admin.textarea type="text" rows="5" wire:model.defer="map" placeholder="Map"  />
	        <x-admin.input-error for="map" />
	    </x-admin.form-group>


	    <x-admin.form-group>
	        <x-admin.lable value="Logo" required />
	        <x-admin.filepond wire:model="logo"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
	        <x-admin.input-error for="logo" />
			    @if($setting->logo)
		          <img src="{{asset('storage/app/public/'.$setting->logo) }}" style="width: 100px; height:100px;" alt=""  />
			    @endif
	    </x-admin.form-group> 


	    

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('admin.dashboard')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>