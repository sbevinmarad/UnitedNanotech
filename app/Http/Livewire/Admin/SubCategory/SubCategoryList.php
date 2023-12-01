<?php

namespace App\Http\Livewire\Admin\SubCategory;

use Livewire\Component;
use App\Models\SubCategory;
use App\Models\Category;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;

class SubCategoryList extends Component
{

	use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchStatus = -1, $perPage = 10, $categoryList=[], $searchCategory;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount()
    {
        $this->perPageList = [
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
        $this->categoryList = Category::get();
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
        $this->searchCategory = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $sub_categoryQuery = SubCategory::query();
        if ($this->searchName)
            $sub_categoryQuery->where('name', 'like', '%' . $this->searchName . '%');
        if ($this->searchCategory)
            $sub_categoryQuery->where('category_id',  $this->searchCategory);
        if ($this->searchStatus >= 0)
            $sub_categoryQuery->where('active', $this->searchStatus);
        return view('livewire.admin.sub-category.sub-category-list', [
            'sub_categories' => $sub_categoryQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        $deleteCategory = SubCategory::find($id['id']);
        $deleteCategory->delete();
        $this->showModal('success', 'Success', 'Sub Category has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this category!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(SubCategory $sub_category)
    {
        $sub_category->fill(['active' => ($sub_category->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Sub Category status has been changed successfully');
    }
    
}
