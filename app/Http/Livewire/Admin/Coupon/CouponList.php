<?php

namespace App\Http\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class CouponList extends Component
{
	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchTotalCost = -1, $perPage = 10, $searchDateFrom, $searchDateTo, $status=[];
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount()
    {
        $this->perPageList = [
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];

        $this->searchDateFrom = date('Y-m-d');
        $this->searchDateTo = date('Y-m-d');
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
        $this->searchTotalCost = -1;
    }

    public function render()
    {
        $couponQuery = Coupon::query();
        if ($this->searchName)
        {
            $couponQuery->where('name', 'like', '%' . $this->searchName . '%')->orWhere('discount', 'like', '%' . $this->searchName . '%');
        }
        $coupons = $couponQuery->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        
        return view('livewire.admin.coupon.coupon-list', [
            'coupons' => $coupons
                
        ]);
    }
    public function deleteConfirm($id)
    {
        $deleteCategory = Coupon::find($id['id']);
        $deleteCategory->delete();
        $msgAction = 'Coupon has been deleted successfully';
        $this->showToastr("success",$msgAction, false);
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this item!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function statusChanged($id)
    {
        $data = ['id' => $id, 'status' =>$this->status];
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to change the coupon status?", 'Yes, Change!', 'changeStatus', $data);
        
    }

    
}
