<?php

namespace App\Http\Livewire\Admin\Enquery;

use PDF;
use Mail;
use App\Mail\EnquerySendmail;
use Livewire\Component;
use App\Models\Enquery;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EnqueryExports;

class EnqueryList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchPhone, $searchStatus = -1, $perPage = 10;
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
        $this->searchPhone = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $enqueryQuery = Enquery::query();
        if ($this->searchName)
        {
            $enqueryQuery->where('name', 'like', '%' . $this->searchName . '%')->orWhere('phone', 'like', '%' . $this->searchName . '%')->orWhere('email', 'like', '%' . $this->searchName . '%')->orWhere('service_name', 'like', '%' . $this->searchName . '%');
        }
        
        
    
        return view('livewire.admin.enquery.enquery-list', [
            'enqueries' => $enqueryQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        Enquery::destroy($id);
        $this->showModal('success', 'Success', 'Enquery has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this enquery!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); 
    }

    public function changeStatus(Enquery $enquery)
    {
        $enquery->fill(['active' => ($enquery->active == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Enquery status has been changed successfully');
    }

    public function exportData()
    {
        
        $enqueryQuery = Enquery::query();
        if ($this->searchName)
        {
            $enqueryQuery->where('name', 'like', '%' . $this->searchName . '%')->orWhere('phone', 'like', '%' . $this->searchName . '%')->orWhere('email', 'like', '%' . $this->searchName . '%')->orWhere('city', 'like', '%' . $this->searchName . '%')->orWhere('pin', 'like', '%' . $this->searchName . '%');
        }
        $data = $enqueryQuery->orderBy($this->sortBy, $this->sortDirection)->get();
        
        if(count($data))
        {

            $filename = "Enquery_Report_".date('Y-m-d').".xlsx";
            return Excel::download(new EnqueryExports($data), $filename);
        }
        else
        {
            $this->showToastr("error",'No data found', false);

        }
    }

    public function sendMail($value)
    {
        $enquery = Enquery::find($value);
        if($enquery)
        {
            $data['id'] = $enquery->id;
            $data['name'] = $enquery->name;
            $data['city'] = $enquery->city;
            $data['pin'] = $enquery->pin;
            $pdf = PDF::loadView('pdf.user_mail_send', $data);
            $data['pdf'] = $pdf;
            /*$email = 'animesh@acuitysoftwareservices.com';*/
            Mail::to($enquery->email)->send(new EnquerySendmail($data));
            $enquery->update(['is_mail_send' => 1]);
            $this->showToastr("success",'Mail send successfully', false);
        }
    }
}
