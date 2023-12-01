<?php

namespace App\Http\Livewire\Admin\Service;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class ServiceList extends Component
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
        $serviceQuery = Service::query();
        if ($this->searchName)
            $serviceQuery->where('name', 'like', '%' . $this->searchName . '%');
        if ($this->searchPrice)
            $serviceQuery->where('price', 'like', '%' . $this->searchPrice . '%');
        
        if ($this->searchStatus >= 0)
            $serviceQuery->where('active', $this->searchStatus);
        return view('livewire.admin.service.service-list', [
            'services' => $serviceQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        Service::destroy($id);
        $this->showModal('success', 'Success', 'service has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this service!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Service $service)
    {
        $service->fill(['active' => ($service->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Service status has been changed successfully');
    }
}
