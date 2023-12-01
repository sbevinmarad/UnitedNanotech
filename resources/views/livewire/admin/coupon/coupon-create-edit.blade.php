<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Coupon Code" required />
            <x-admin.input type="text" wire:model.defer="name" placeholder="Coupon Code"  />
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
            <x-admin.lable value="Discount Type" required/>
            <x-admin.dropdown  wire:model.defer="discount_type" placeHolderText="Please select one" autocomplete="off" >
                    @foreach ($typeList as $type)
                        <x-admin.dropdown-item  :value="$type['value']" :text="$type['text']"/>                          
                    @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="discount_type" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Discount " required />
            <x-admin.input type="text" wire:model.defer="discount" placeholder="Discount"  /> 
            <x-admin.input-error for="discount" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Start date" required />
            <x-admin.input type="date" wire:model.defer="start_date" placeholder="Start date"   /> 
            <x-admin.input-error for="start_date" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="End date" required />
            <x-admin.input type="date" wire:model.defer="end_date" placeholder="End date"  /> 
            <x-admin.input-error for="end_date" />
        </x-admin.form-group>

        

        
        </div>
        <br/>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('coupons.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>
