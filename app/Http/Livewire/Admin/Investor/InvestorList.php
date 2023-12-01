<?php

namespace App\Http\Livewire\Admin\Investor;

use Livewire\Component;
use App\Models\Investor;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class InvestorList extends Component
{

	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];


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
        $investorQuery = Investor::query();
        if ($this->searchName)
            $investorQuery->where('name', 'like', '%' . $this->searchName . '%');
        if ($this->searchStatus >= 0)
            $investorQuery->where('active', $this->searchStatus);
        return view('livewire.admin.investor.investor-list', [
            'investors' => $investorQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        $deleteinvestor = Investor::find($id['id']);
        $deleteinvestor->delete();
        $this->showModal('success', 'Success', 'Investor has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this investor!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Investor $investor)
    {
        $investor->fill(['active' => ($investor->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Investor status has been changed successfully');
    }
   
}
