<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group class="col-lg-12">
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
	        <x-admin.lable value="Image" required />
	        <x-admin.filepond wire:model="image"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            @if($blog->image)
            	<img src="{{asset('storage/app/public/'.$blog->image) }}" style="width: 150px; height:100px;display: inline-block ;" />
            @endif
	        <x-admin.input-error for="image" />

	    </x-admin.form-group>
	   
	    

	     <x-admin.form-group class="col-lg-12" wire:ignore>
	        <x-admin.lable value="Description" />
	        <textarea  id="page_content"  placeholder="Description" rows="6" >{{$blog->description}}</textarea>
	        <input type="hidden" wire.model="description">
	    </x-admin.form-group>

	    <x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Seo Title" />
	        <x-admin.input type="text" wire:model.defer="seo_title" placeholder="Seo Title" rows="6" />
	        <x-admin.input-error for="seo_title" />
	    </x-admin.form-group>


	     <x-admin.form-group>
	        <x-admin.lable value="Seo Description" />
	        <x-admin.textarea type="text" wire:model.defer="seo_description" placeholder="Seo Description" rows="6" />
	        <x-admin.input-error for="seo_description" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Seo Keywords" />
	        <x-admin.textarea type="text" wire:model.defer="seo_keywords" placeholder="Seo Keywords" rows="6" />
	        <x-admin.input-error for="seo_keywords" />
	    </x-admin.form-group>

	    

		<script src="{{asset('public/admin_assets/vendors/general/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
	    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>  
	

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" id="submitBtn" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('services.index')" color="secondary">Cancel</x-admin.link>

    <script type="text/javascript">
   

	    var editor1 = CKEDITOR.replace('page_content', {
	        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
	        filebrowserUploadMethod: 'form'
	    });
	    editor1.config.allowedContent = true;

	    $('#submitBtn').click(function(){
	      	@this.set('description', editor1.getData());
	    })
	</script>
    </x-slot>

</x-form-section>