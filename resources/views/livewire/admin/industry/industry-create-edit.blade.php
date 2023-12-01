<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group>
	        <x-admin.lable value="Industry Name" required />
	        <x-admin.input type="text" wire:model.defer="name" placeholder="Industry Name"  />
	        <x-admin.input-error for="name" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Image" required />
	        <x-admin.filepond wire:model="image"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            @if($industry->image)
            	<img src="{{asset('storage/app/public/'.$industry->image) }}" style="width: 150px; height:100px;display: inline-block ;" />
            @endif
	        <x-admin.input-error for="image" />

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
        <x-admin.link :href="route('industries.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>