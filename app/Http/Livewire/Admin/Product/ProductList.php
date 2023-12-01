<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class ProductList extends Component
{
	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchPrice, $searchStatus = -1, $perPage = 10, $searchPopular=-1,$deleteIds=[], $all_ids;
    protected $listeners = ['deleteConfirm', 'changeStatus', 'changePopular', 'deleteConfirmMultiDelete'];

    public function mount()
    {
        $this->perPageList = [
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
    }
    public function getRandomColor()
    {
        $arrIndex = array_rand($this->badgeColors);
        return $this->badgeColors[$arrIndex];
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }
    public function resetSearch()
    {
        $this->searchName = "";
        $this->searchPrice = "";
        $this->searchStatus = -1;
        $this->searchPopular = -1;
    }

    public function render()
    {
        $productQuery = Product::query();
        if ($this->searchName)
            $productQuery->where('name', 'like', '%' . $this->searchName . '%');
        if ($this->searchPrice)
            $productQuery->where('price', 'like', '%' . $this->searchPrice . '%');
        
        if ($this->searchStatus >= 0)
            $productQuery->where('active', $this->searchStatus);
        if ($this->searchPopular >= 0)
            $productQuery->where('is_popular', $this->searchPopular);

        return view('livewire.admin.product.product-list', [
            'products' => $productQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        Product::destroy($id);
        $this->showModal('success', 'Success', 'product has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this product!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Product $product)
    {
        $product->fill(['active' => ($product->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Product status has been changed successfully');
    }

    public function changePopularConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changePopular', ['id' => $id]); 
    }

    public function changePopular(Product $product)
    {
        $product->fill(['is_popular' => ($product->is_popular == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Product status has been changed successfully');
    }

    public function deleteMultiProduct()
    {
        if(count($this->deleteIds)>0)
            $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Products!", 'Yes, delete!', 'deleteConfirmMultiDelete', ['id' => $this->deleteIds]);
        else{

            $msgAction = 'Please Select atleast one record';
            $this->showToastr("success",$msgAction , false);
        }
    }   

    public function deleteConfirmMultiDelete($ids)
    {
        if(count($ids))
        {
            foreach ($ids as $key => $value) {
                if($value)
                {
                    Product::whereIn('id', $value)->delete();
                }
                
            }
            $msgAction = 'Record deleted successfully';
            $this->showToastr("success",$msgAction , false);
        }
    }

    public function updatedAllIds($value)
    {
        if($value)
        {
           $products = Product::orderBy($this->sortBy, $this->sortDirection)->get();
            if(count($products))
            {
                foreach ($products as $key => $value) {
                    $this->deleteIds[$key] = $value->id;
                }
            }
        }
        else{
            $products = Product::orderBy($this->sortBy, $this->sortDirection)->get();
            if(count($products))
            {
                foreach ($products as $key => $value) {
                    $this->deleteIds[$key] = false;
                }
            }
        }
    }
    
}
