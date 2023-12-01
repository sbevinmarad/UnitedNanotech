<?php

namespace App\Http\Livewire\Admin\Order;

use Mail;
use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetails;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\AlertMessage;
use App\Mail\OrderStatusMail;

class OrderList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $searchName, $searchPhone, $searchStatus, $perPage = 10,$deleteIds=[], $all_ids, $status=[];
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
        $this->searchPhone = "";
        $this->searchStatus = "";
    }

    public function render()
    {
        $orderQuery = Order::where('active', 1)->where('status', '!=', 2);
        if ($this->searchName){
            $orderQuery->where('customer_name', 'like', '%' . $this->searchName . '%')->orWhere('customer_phone', 'like', '%' . $this->searchName . '%')->orWhere('p_order_id', 'like', '%' . $this->searchName . '%');
        }
        if ($this->searchPhone)
            $orderQuery->where('customer_phone', 'like', '%' . $this->searchPhone . '%');
        if ($this->searchStatus)
            $orderQuery->where('delivery_type',  $this->searchStatus );

        $orders = $orderQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage);

        if(count($orders))
        {
            foreach ($orders as $key => $value) {
                $this->status[$value->id] =$value->status;
            }
        }

        return view('livewire.admin.order.order-list', [
            'orders' => $orders
        ]);
    }
    public function deleteConfirm($id)
    {
        Order::destroy($id);
        $this->showModal('success', 'Success', 'order has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this order!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function deleteMultiOrder()
    {
        if(count($this->deleteIds)>0)
            $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this orders!", 'Yes, delete!', 'deleteConfirmMultiDelete', ['id' => $this->deleteIds]);
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
                    Order::whereIn('id', $value)->delete();
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
           $itemOrder = Order::orderBy($this->sortBy, $this->sortDirection)->get();
            if(count($itemOrder))
            {
                foreach ($itemOrder as $key => $value) {
                    $this->deleteIds[$key] = $value->id;
                }
            }
        }
        else{
            $itemOrder = Order::orderBy($this->sortBy, $this->sortDirection)->get();
            if(count($itemOrder))
            {
                foreach ($itemOrder as $key => $value) {
                    $this->deleteIds[$key] = false;
                }
            }
        }
    }

    public function statusChanged($id)
    {
        $data = ['id' => $id, 'status' =>$this->status];
        if($value = '1')
        {
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to approve the order status request?", 'Yes, Change!', 'changeStatus', $data);
        }
        else
        {
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to cancel the order status request?", 'Yes, Change!', 'changeStatus', $data);  
        }
    }

    public function changeStatus($id)
    {
        $data_id = $id['id'];
        $data_status = $id['status'];

        $orderData = Order::find($data_id);

        if($orderData)
        {
            $data['order_id'] = $orderData->id;
            if($data_status[$data_id] == '1')
            {
                $data['message'] = 'Your order has been accepted';
                Mail::to($orderData->customer_email)->send(new OrderStatusMail($data));
            }
            elseif($data_status[$data_id] == '2')
            {
                $data['message'] = 'We are happy to let you know that an item from your order has been delivered.';
                Mail::to($orderData->customer_email)->send(new OrderStatusMail($data));
            }
            elseif($data_status[$data_id] == '3')
            {
                $data['message'] = 'Your order has been cancelled';
                Mail::to($orderData->customer_email)->send(new OrderStatusMail($data));
            }
            $orderData->update([
                'status' => $data_status[$data_id],
            ]);
            $msgAction = 'Order Status changed successfully';
            $this->showToastr("success",$msgAction , false);
        }

    }
}
