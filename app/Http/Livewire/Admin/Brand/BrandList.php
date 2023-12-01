<?php

namespace App\Http\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class BrandList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchStatus = -1, $perPage = 10,$deleteIds=[], $all_ids;
    protected $listeners = ['deleteConfirm', 'changeStatus', 'deleteConfirmMultiDelete'];

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
        $this->searchStatus = -1;
    }

    public function render()
    {
        $brandQuery = Brand::query();
        if ($this->searchName)
            $brandQuery->where('name', 'like', '%' . $this->searchName . '%');
        if ($this->searchStatus >= 0)
            $brandQuery->where('active', $this->searchStatus);
        return view('livewire.admin.brand.brand-list', [
            'brands' => $brandQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        $deletebrand = Brand::find($id['id']);
        $deletebrand->delete();
        $this->showModal('success', 'Success', 'Brand has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this brand!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Brand $brand)
    {
        $brand->fill(['active' => ($brand->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Brand status has been changed successfully');
    }

    public function deleteMultiBrand()
    {
        if(count($this->deleteIds)>0)
            $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this brands!", 'Yes, delete!', 'deleteConfirmMultiDelete', ['id' => $this->deleteIds]);
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
                    Brand::whereIn('id', $value)->delete();
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
           $brands = Brand::orderBy($this->sortBy, $this->sortDirection)->get();
            if(count($brands))
            {
                foreach ($brands as $key => $value) {
                    $this->deleteIds[$key] = $value->id;
                }
            }
        }
        else{
            $brands = Brand::orderBy($this->sortBy, $this->sortDirection)->get();
            if(count($brands))
            {
                foreach ($brands as $key => $value) {
                    $this->deleteIds[$key] = false;
                }
            }
        }
    }
}
