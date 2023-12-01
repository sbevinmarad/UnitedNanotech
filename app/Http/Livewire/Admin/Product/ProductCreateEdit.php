<?php

namespace App\Http\Livewire\Admin\Product;

use Str;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\ProductFile;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class ProductCreateEdit extends Component
{
    use AlertMessage,WithFileUploads;
    public $name,$active=1,$images=[],$product, $price, $description, $rating, $is_hot_item=0;
    public $isEdit=false, $category_id,$sub_category_id, $gst=null, $is_popular=0, $is_featured=0, $image, $file, $packaging_type, $packaging_size;
    public $statusList=[], $categoryList=[], $optionList=[],$subCategoryList =[], $options, $files=[];
    protected $listeners = ['deleteConfirm', 'changeStatus', 'deleteConfirmFile'];
    public function mount($product = null)
    {
        if ($product) {
            $this->product = $product;
            $this->fill($this->product);
            $this->isEdit=true;
            $this->subCategoryList = SubCategory::where('category_id', $product->category_id)->where('active', 1)->get();
        }
        else
            $this->product=new Product;

        
        $this->statusList=[
            ['value'=>"", 'text'=> "Select Status"],
            ['value'=>1, 'text'=> "Active"],
            ['value'=>0, 'text'=> "Inactive"]
        ];

        $this->options=
            ['value'=>null, 'text'=> "Select Sub Category"];
        $this->optionList=[
            ['value'=>"", 'text'=> "Select One"],
            ['value'=>1, 'text'=> "Yes"],
            ['value'=>0, 'text'=> "No"]
        ];
        $this->categoryList = Category::where('active', 1)->orderBy('name')->get();
    }

    public function updatedCategoryId($value)
    {
        $this->subCategoryList = SubCategory::where('category_id', $value)->where('active', 1)->get();
    }
    public function updatedGst($value)
    {
        if($value == ""){
            $this->gst = null;
        }
        else{
            $this->gst = $value;
        }
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'name' => ['required'],
                'images'=>['required'],
                'packaging_type'=>['required'],
                'packaging_size'=>['required'],
                'active'=>['required'],
                'image'=>['required'],
                'category_id'=>['required'],
                'description'=>['required'],
                'files'=>['nullable'],
            ];
    }
    public function validationRuleForUpdate(): array
    {
        return[
                'name' => ['required'],
                'packaging_type'=>['required'],
                'packaging_size'=>['required'],
                'active'=>['required'],
                'category_id'=>['required'],
                'description'=>['required'],   
                'files'=>['nullable'],         
            ];
    }

    public function saveOrUpdate()
    {
        if($this->sub_category_id == ""){
            $this->sub_category_id = null;
        }
        $this->product->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();

        if(count($this->images))
        {
            foreach ($this->images as $key => $value) {
                if(gettype($value) != 'string'){
                    $image = time() . '-' . rand(1000, 9999) . '.' . $value->getClientOriginalExtension();       
                    $value->storeAs('public/product_images',$image);
                    $imageFileName = 'product_images/'.$image;
                    

                    ProductImage::create(['product_id' => $this->product->id, 'image' => $imageFileName]);
                }
                
            }
        }
        if(count($this->files))
        {
            foreach ($this->files as $key => $value) {
                if(gettype($value) != 'string'){
                    $image = time() . '-' . rand(1000, 9999) . '.' . $value->getClientOriginalExtension();       
                    $value->storeAs('public/product_files',$image);
                    $pdfFileName = 'product_files/'.$image;
                    

                    ProductFile::create(['product_id' => $this->product->id, 'image' => $pdfFileName]);
                }
                
            }
        }
        if(gettype($this->image) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->image->getClientOriginalExtension();       
            $this->image->storeAs('public/product_images',$image);
            $fileName2 = 'product_images/'.$image;
            if(isset($this->product->image))
            {
                @unlink(storage_path('app/public/' .$this->product->image));
            }
        }
        else{

            $fileName2 = $this->product->image;
        } 

        /*if(gettype($this->file) != 'string'){
            $image = time() . '-' . rand(1000, 9999) . '.' . $this->file->getClientOriginalExtension();       
            $this->file->storeAs('public/product_images',$image);
            $fileName3 = 'product_images/'.$image;
            if(isset($this->product->image))
            {
                @unlink(storage_path('app/public/' .$this->product->file));
            }
        }
        else{

            $fileName3 = $this->product->file;
        }*/

        
        $this->product->update([
            'slug'=> Str::slug($this->name),
            'image' => $fileName2,
        ]);
        
        $msgAction = 'Product was '. ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success",$msgAction);

        return redirect()->route('products.index');
    }
    public function render()
    {
        return view('livewire.admin.product.product-create-edit');
    }

    public function deleteConfirm($id)
    {
        $image = ProductImage::find($id['id']);
        $count = count($this->product->productImages);
        if($count >1)
        {
           if(isset($image->image))
        {
            @unlink(storage_path('app/public/' .$image->image));
            $image->delete();
        }
        $msgAction = 'product Image has been deleted successfully';
        $this->showToastr("success",$msgAction);
        return redirect()->route('products.edit', ['product' => $this->product->id]);
         
        }
        else{
           $this->showModal('error', 'Error', 'Atleast one image required'); 
        }
        
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this image!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function deleteConfirmFile($id)
    {
        $image = ProductFile::find($id['id']);
       
        if(isset($image->image))
        {
            @unlink(storage_path('app/public/' .$image->image));
            $image->delete();
        }
        $msgAction = 'File has been deleted successfully';
        $this->showToastr("success",$msgAction);
        return redirect()->route('products.edit', ['product' => $this->product->id]);
         
        
        
    }
    public function deleteAttemptFile($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this image!", 'Yes, delete!', 'deleteConfirmFile', ['id' => $id]); 
    }
}
