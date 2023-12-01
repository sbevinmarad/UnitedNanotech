<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    	<x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Product Name" required />
	        <x-admin.input type="text" wire:model.defer="name" placeholder="Product Name"  />
	        <x-admin.input-error for="name" />
	    </x-admin.form-group>


	    <x-admin.form-group>
	        <x-admin.lable value="Category Name" required/>
	        <x-admin.dropdown  wire:model="category_id" placeHolderText="Please select one" autocomplete="off" >
	                    <x-admin.dropdown-item  :value="''" :text="'Select Category'"/>                          
	                @foreach ($categoryList as $item)
	                    <x-admin.dropdown-item  :value="$item['id']" :text="$item['name']"/>                          
	                @endforeach
	        </x-admin.dropdown>
	        <x-admin.input-error for="category_id" />
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
	        <x-admin.lable value="Packaging Type" required />
	        <x-admin.input type="text" wire:model.defer="packaging_type" placeholder="Packaging Type"  />
	        <x-admin.input-error for="packaging_type" />
	    </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Packaging Size" required />
	        <x-admin.input Size="text" wire:model.defer="packaging_size" placeholder="Packaging Type"  />
	        <x-admin.input-error for="packaging_size" />
	    </x-admin.form-group>

	    

	     

	    <x-admin.form-group>
            <x-admin.lable value="Default Image" required />
            <x-admin.filepond wire:model="image"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/*']"
                    allowFileSizeValidation
                    maxFileSize="10mb" multiple/>
            
            <x-admin.input-error for="image" />

            @if($product->image)
          <img src="{{asset('storage/app/public/'.$product->image) }}" style="width: 150px; height:100px;" alt=""  />
        @endif

        </x-admin.form-group>

	    <x-admin.form-group>
	        <x-admin.lable value="Images(Multiple)" required />
	        <x-admin.filepond wire:model="images"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/*']"
                    allowFileSizeValidation
                    maxFileSize="10mb" multiple/>
            
	        <x-admin.input-error for="images" />

	    </x-admin.form-group>
	   

        

	    

	    @if(count($product->productImages))
	    <x-admin.form-group class="col-lg-12">
	    @foreach($product->productImages as $image)
	    	<div class="remove_image" wire:click="deleteAttempt({{ $image->id }})">
            <img src="{{asset('storage/app/public/'.$image->image) }}" style="width: 150px; height:100px;display: inline-block ;" />
            <div class="delete_icon">X</div>
            </div>
        @endforeach
	    </x-admin.form-group>
        @endif

        <x-admin.form-group>
            <x-admin.lable value="PDF Files(Multiple)"  />
            <x-admin.filepond wire:model="files"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['application/pdf']"
                    allowFileSizeValidation
                    maxFileSize="100mb" multiple/>
            
            <x-admin.input-error for="files" />

        </x-admin.form-group >

        @if(count($product->productFiles))
        <x-admin.form-group class="col-lg-12">
        @foreach($product->productFiles as $image)
            <div class="remove_image" wire:click="deleteAttemptFile({{ $image->id }})">
            <iframe src="{{ asset('storage/app/public/'.$image->image)}}" style="width: 100%; height:200px;"></iframe>
            
            <div class="delete_icon">X</div>
            </div>
        @endforeach
        </x-admin.form-group>
        @endif
            

        

	    <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Description" />
            <textarea  id="description"  placeholder="Description" rows="6" >{{$product->description}}</textarea>
            <input type="hidden" wire.model="description">
        </x-admin.form-group>

        <script src="{{asset('public/admin_assets/vendors/general/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled" id="submitBtn">Save</x-admin.button>
        <x-admin.link :href="route('products.index')" color="secondary">Cancel</x-admin.link>
        <script type="text/javascript">
   
            var editor1 = CKEDITOR.replace('description', {
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