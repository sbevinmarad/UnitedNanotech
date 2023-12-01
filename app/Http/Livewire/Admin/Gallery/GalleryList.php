<?php

namespace App\Http\Livewire\Admin\Gallery;

use Livewire\Component;
use App\Models\Gallery;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class GalleryList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchStatus = -1, $perPage = 10;
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
        $this->searchStatus = -1;
    }

    public function render()
    {
        $galleryQuery = Gallery::query();
        if ($this->searchStatus >= 0)
            $galleryQuery->where('active', $this->searchStatus);
        return view('livewire.admin.gallery.gallery-list', [
            'galleries' => $galleryQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        $data = Gallery::find($id['id']);
        if(isset($data->image))
        {
            @unlink(storage_path('app/public/' .$data->image));
            @unlink(storage_path('app/public/thumbnail/' .$data->image));
        }
        $data->delete();
        $this->showModal('success', 'Success', 'Image has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this image!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Gallery $gallery)
    {
        $gallery->fill(['active' => ($gallery->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Gallery status has been changed successfully');
    }
}
