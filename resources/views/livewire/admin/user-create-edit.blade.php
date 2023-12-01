<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
            <x-admin.form-group>
                <x-admin.lable value="First Name" required />
                <x-admin.input type="text" wire:model.defer="first_name" placeholder="First Name"  />
                <x-admin.input-error for="first_name" />
            </x-admin.form-group>
            <x-admin.form-group>
                <x-admin.lable value="Last Name"  required />
                <x-admin.input type="text" wire:model.defer="last_name" placeholder="Last Name"   />
                <x-admin.input-error for="last_name" />
            </x-admin.form-group>
            <x-admin.form-group>
                <x-admin.lable value="Email" required />
                <x-admin.input type="text" wire:model.defer="email" placeholder="Email" autocomplete="off"/>
                <x-admin.input-error for="email" />
            </x-admin.form-group>
            <x-admin.form-group>
                <x-admin.lable value="User ID" required />
                <x-admin.input type="text" wire:model.defer="user_id" placeholder="User ID" autocomplete="off" />
                <x-admin.input-error for="user_id" />
            </x-admin.form-group>
            @if(!$isEdit)
            <x-admin.form-group>
                <x-admin.lable value="Password"  required />
                <x-admin.input type="password" wire:model.defer="password" placeholder="Password" autocomplete="off" />
                <x-admin.input-error for="password" />
            </x-admin.form-group>

            <x-admin.form-group>
                <x-admin.lable value="Confirm Password"  required />
                <x-admin.input type="password" wire:model.defer="password_confirmation" placeholder="Re enter Password" autocomplete="off" />
                <x-admin.input-error for="password_confirmation" />
            </x-admin.form-group>
            @endif
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
        <x-admin.link :href="route('users.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>