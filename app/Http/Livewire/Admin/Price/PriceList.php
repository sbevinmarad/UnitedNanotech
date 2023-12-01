<?php

namespace App\Http\Livewire\Admin\Price;

use Livewire\Component;
use App\Models\PricePlan;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class PriceList extends Component
{
	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchPrice, $searchStatus = -1, $perPage = 10;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

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
    }

    public function render()
    {
        $priceQuery = PricePlan::query();
        if ($this->searchName)
            $priceQuery->where('name', 'like', '%' . $this->searchName . '%');
        if ($this->searchPrice)
            $priceQuery->where('price', 'like', '%' . $this->searchPrice . '%');
        
        if ($this->searchStatus >= 0)
            $priceQuery->where('active', $this->searchStatus);
        return view('livewire.admin.price.price-list', [
            'prices' => $priceQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        PricePlan::destroy($id);
        $this->showModal('success', 'Success', 'price has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this price!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(PricePlan $price_plan)
    {
        $price_plan->fill(['active' => ($price_plan->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Price status has been changed successfully');
    }
}
