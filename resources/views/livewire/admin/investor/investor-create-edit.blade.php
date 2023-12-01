<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
	    <x-admin.form-group >
	        <x-admin.lable value="Name"  />
	        <x-admin.input type="text" wire:model.defer="name" placeholder="Name" />
	        <x-admin.input-error for="name" />
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

	    <x-admin.form-group>
	        <x-admin.lable value="Image" required />
	        <x-admin.filepond wire:model="image"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/*', 'application/pdf']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
	        <x-admin.input-error for="image" />
	        @if($isEdit)
	        	@if(str_ends_with($investor->image, '.pdf'))
	        		<iframe src="{{ asset('storage/app/public/'.$investor->image)}}" style="width: 100%; height:200px;"></iframe>
	        	@else
		          <img src="{{asset('storage/app/public/'.$investor->image) }}" style="width: 200px; height:60px;" alt=""  />
		          @endif
		        
		    @endif
	    </x-admin.form-group>

	    

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('investors.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>