<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group >
	        <x-admin.lable value="Title" required />
	        <x-admin.input type="text" wire:model.defer="title" placeholder="Title"  />
	        <x-admin.input-error for="title" />
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
	    	<x-admin.lable value="Description" required />
	        <x-admin.textarea wire:model.defer="description" rows="6" placeholder="Message"  />
	        <x-admin.input-error for="description" />
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
			    @if($work_process->image)
		          <img src="{{asset('storage/app/public/'.$work_process->image) }}" style="width: 100px; height:100px;" alt=""  />
		       
			    @endif
		    @endif
	    </x-admin.form-group>

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled" id="submitBtn">Save</x-admin.button>
        <x-admin.link :href="route('work-processes.index')" color="secondary">Cancel</x-admin.link>
        
    </x-slot>
</x-form-section>