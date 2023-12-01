<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
	    <x-admin.form-group>
	        <x-admin.lable value="Category Name" required />
	        <x-admin.input type="text" wire:model.defer="name" placeholder="Category Name"  />
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
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
	        <x-admin.input-error for="image" />
	        @if($isEdit)
			    @if($category->image)
		          <img src="{{asset('storage/app/public/'.$category->image) }}" style="width: 100px; height:100px;" alt=""  />
		        @else
		          <img src="{{asset('public/assets/images/no_image.png') }}" alt="" style="width: 100px; height:100px;"/>
			    @endif
		    @endif
	    </x-admin.form-group>
	    

	    <x-admin.form-group>
	    	<x-admin.lable value="Description" required />
	        <x-admin.textarea wire:model.defer="description" rows="6" placeholder="Message"  />
	        <x-admin.input-error for="description" />
	    </x-admin.form-group>

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('categories.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>