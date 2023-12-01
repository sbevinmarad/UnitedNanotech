<?php

namespace App\Http\Livewire\Admin\WorkProcess;

use Livewire\Component;
use App\Models\WorkProcess;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class WorkProcessList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchRating, $searchStatus = -1, $perPage = 10;
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
        $this->searchRating = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $work_processQuery = WorkProcess::query();
        if ($this->searchName)
            $work_processQuery->where('title', 'like', '%' . $this->searchName . '%');
        if ($this->searchStatus >= 0)
            $work_processQuery->where('active', $this->searchStatus);
        return view('livewire.admin.work-process.work-process-list', [
            'processes' => $work_processQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        WorkProcess::destroy($id);
        $this->showModal('success', 'Success', 'Work process has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this work process!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(WorkProcess $work_process)
    {
        $work_process->fill(['active' => ($work_process->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Work process status has been changed successfully');
    }
}
