<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
	    <x-admin.form-group class="col-lg-12">
	        <x-admin.lable value="Page Title" required />
	        <x-admin.input type="text" wire:model.defer="title" placeholder="Title"  readonly/>
	        <x-admin.input-error for="title" />
	    </x-admin.form-group>

       
        

        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_1"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_1" />
            <img src="{{asset('storage/app/public/'.$cms->image_1) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content" />
            <textarea placeholder="Content" id="description_1" rows="12" >{{$cms->description_1}}</textarea>
            <input type="hidden" wire.model="description_1">
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_2"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_2" />
            <img src="{{asset('storage/app/public/'.$cms->image_2) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content 2" />
            <textarea placeholder="Content" id="description_2" rows="12" >{{$cms->description_2}}</textarea>
            <input type="hidden" wire.model="description_2">
        </x-admin.form-group>

        @if($cms->slug == 'vision-statement' || $cms->slug == 'mission-statement' || $cms->slug == 'our-team' || $cms->slug == 'our-clients' || $cms->slug == 'our-presence' || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_3"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_3" />
            <img src="{{asset('storage/app/public/'.$cms->image_3) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content 3" />
            <textarea placeholder="Content" id="description_3" rows="12" >{{$cms->description_3}}</textarea>
            <input type="hidden" wire.model="description_3">
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_4"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_4" />
            <img src="{{asset('storage/app/public/'.$cms->image_4) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content 4" />
            <textarea placeholder="Content" id="description_4" rows="12" >{{$cms->description_4}}</textarea>
            <input type="hidden" wire.model="description_4">
        </x-admin.form-group>

        @if($cms->slug == 'vision-statement' || $cms->slug == 'mission-statement' || $cms->slug == 'our-team'  || $cms->slug == 'our-presence' || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_5"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_5" />
            <img src="{{asset('storage/app/public/'.$cms->image_5) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content 5" />
            <textarea placeholder="Content" id="description_5" rows="12" >{{$cms->description_5}}</textarea>
            <input type="hidden" wire.model="description_5">
        </x-admin.form-group>


        @if($cms->slug == 'vision-statement' || $cms->slug == 'our-team'   || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_6"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_6" />
            <img src="{{asset('storage/app/public/'.$cms->image_6) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content 6" />
            <textarea placeholder="Content" id="description_6" rows="12" >{{$cms->description_6}}</textarea>
            <input type="hidden" wire.model="description_6">
        </x-admin.form-group>

        @if($cms->slug == 'our-team' || $cms->slug == 'carrer')
        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_7"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_7" />
            <img src="{{asset('storage/app/public/'.$cms->image_7) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content 7" />
            <textarea placeholder="Content" id="description_7" rows="12" >{{$cms->description_7}}</textarea>
            <input type="hidden" wire.model="description_7">
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_8"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_8" />
            <img src="{{asset('storage/app/public/'.$cms->image_8) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content 8" />
            <textarea placeholder="Content" id="description_8" rows="12" >{{$cms->description_8}}</textarea>
            <input type="hidden" wire.model="description_8">
        </x-admin.form-group>


        @endif
        @endif
        @endif
        @endif
        @if($cms->slug == 'our-team')

        <x-admin.form-group>
            <x-admin.lable value="Image" required />
            <x-admin.filepond wire:model="image_9"
                    allowImagePreview
                    imagePreviewMaxHeight="50"
                    allowFileTypeValidation
                    acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                    allowFileSizeValidation
                    maxFileSize="10mb"/>
            <x-admin.input-error for="image_9" />
            <img src="{{asset('storage/app/public/'.$cms->image_9) }}" style="width: 150px; height:100px;display: inline-block ;" />
            
        </x-admin.form-group>

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content 9" />
            <textarea placeholder="Content" id="description_9" rows="12" >{{$cms->description_9}}</textarea>
            <input type="hidden" wire.model="description_9">
        </x-admin.form-group>
        @endif

        @if($cms->slug == 'carrer')
        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Content" />
            <textarea  id="description"  placeholder="Content" rows="12" >{{$cms->description}}</textarea>
            <input type="hidden" wire.model="description">
        </x-admin.form-group>
        @endif

    	
        <script src="{{asset('public/admin_assets/vendors/general/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
        
	    </div>
	    <br>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled" id="submitBtn">Save</x-admin.button>
        <x-admin.link :href="route('cms.index')" color="secondary">Cancel</x-admin.link>
        <script type="text/javascript">
   
            console.log('okk')
            
            var editor1 = CKEDITOR.replace('description_1', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor1.config.allowedContent = true;

            var editor2 = CKEDITOR.replace('description_2', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor2.config.allowedContent = true;
            
            @if($cms->slug == 'vision-statement' || $cms->slug == 'mission-statement' || $cms->slug == 'our-team' || $cms->slug == 'our-clients' || $cms->slug == 'our-presence' || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
            var editor3 = CKEDITOR.replace('description_3', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor3.config.allowedContent = true;
            
            var editor4 = CKEDITOR.replace('description_4', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor4.config.allowedContent = true;

            @if($cms->slug == 'vision-statement' || $cms->slug == 'mission-statement' || $cms->slug == 'our-team'  || $cms->slug == 'our-presence' || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
            
            var editor5 = CKEDITOR.replace('description_5', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor5.config.allowedContent = true;

            @if($cms->slug == 'vision-statement' || $cms->slug == 'our-team'   || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
            
            var editor6 = CKEDITOR.replace('description_6', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor6.config.allowedContent = true;

            @if($cms->slug == 'our-team' || $cms->slug == 'carrer')
            
            var editor7 = CKEDITOR.replace('description_7', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor7.config.allowedContent = true;
            
            var editor8 = CKEDITOR.replace('description_8', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor8.config.allowedContent = true;
            @endif
            @endif
            @endif
            @endif
            
             @if($cms->slug == 'our-team')
            var editor9 = CKEDITOR.replace('description_9', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor9.config.allowedContent = true;
            @endif
            @if($cms->slug == 'carrer')
            var editor10 = CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            editor10.config.allowedContent = true;

            @endif

            $('#submitBtn').click(function(){
                @this.set('description_1', editor1.getData());
                @this.set('description_2', editor2.getData());

                @if($cms->slug == 'vision-statement' || $cms->slug == 'mission-statement' || $cms->slug == 'our-team' || $cms->slug == 'our-clients' || $cms->slug == 'our-presence' || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
                @this.set('description_3', editor3.getData());
                @this.set('description_4', editor4.getData());

                @if($cms->slug == 'vision-statement' || $cms->slug == 'mission-statement' || $cms->slug == 'our-team'  || $cms->slug == 'our-presence' || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
                @this.set('description_5', editor5.getData());

                @if($cms->slug == 'vision-statement' || $cms->slug == 'our-team'   || $cms->slug == 'infrastructure' || $cms->slug == 'carrer')
                @this.set('description_6', editor6.getData());
                @if($cms->slug == 'our-team' || $cms->slug == 'carrer')
                @this.set('description_7', editor7.getData());
                @this.set('description_8', editor8.getData());
                @endif
                @endif
                @endif
                @endif
                @if($cms->slug == 'our-team')
                @this.set('description_9', editor9.getData());
                @endif
                 @if($cms->slug == 'carrer')
                @this.set('description', editor10.getData());
                @endif
            })
        </script>
    </x-slot>
</x-form-section>