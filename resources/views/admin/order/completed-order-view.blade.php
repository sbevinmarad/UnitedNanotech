<x-admin-layout title="Completed Order Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Order View">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('completed.orders') }}" value="Completed Order List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('completed.orders')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-angle-left"></i>
                        Back
                    </a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	<div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Completed Order Details
                </h3>
            </div>
        </div>
       <div class="kt-portlet__body">
            <div class="kt-section">
                <div class="kt-section__content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 250px;">Customer Name</th>
                                    <td>{{ $order->customer_name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Customer Email</th>
                                    <td>{{$order->customer_email}}</td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">Customer Phone Number</th>
                                    <td>{{$order->customer_phone}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Order ID</th>
                                    <td>{{$order->r_order_id}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Customer Address</th>
                                    <td>{{$order->address}} {{$order->road}} {{$order->city}} {{$order->district}} {{$order->state->state}} {{$order->pin_code}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Order Date</th>
                                    <td>{{$order->created_at->format('d M, Y')}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Payment Mode</th>
                                    <td>{{$order->payment_mode}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Order Status</th>
                                    <td>@if($order->status == '0')
                                            Pending
                                        @elseif($order->status == '1')
                                            Accepted
                                        @elseif($order->status == '2')
                                            Delivered
                                        @elseif($order->status == '3')
                                            Cancelled
                                        @endif</td>
                                </tr>

                                @if($order->r_payment_id)
                                <tr>
                                    <th scope="row">Transaction ID</th>
                                    <td>{{$order->r_payment_id}}</td>
                                </tr>
                                @endif

                                
                                 
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-section">
                <div class="kt-section__content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><th colspan="4">Product Details</th></tr>
                                @if(count($order->order_details)>0)
                                <tr>
                                    <th scope="row" style="width: 200px;">Product Name</th>
                                    <!-- <th scope="row" style="width: 200px;">Size</th> -->
                                    <th scope="row" style="width: 200px;">Quantity</th>
                                    <th scope="row" style="width: 200px;">Price</th>
                                    <th scope="row" style="width: 200px;">Total Price</th>
                                </tr>
                                @php
                                    $sub_total = 0;
                                    $tax = 0;
                                @endphp
                                @foreach($order->order_details as $details)
                                @php
                                    $sub_total+= ($details->quantity*$details->price);

                                @endphp
                                <tr>
                                    <td>{{$details->product_name}}</td>
                                    <!-- <td>{{$details->size}}</td> -->
                                    <td>{{$details->quantity}}</td>
                                    <td>{{env('CURRENCY')}}{{number_format($details->price,2)}}</td>
                                    <td>{{env('CURRENCY')}}{{number_format($details->total,2)}}</td>
                                </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td colspan="3">Sub Total</td>
                                    <td >{{env('CURRENCY')}}{{number_format($sub_total,2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Vat/ GST</td>
                                    <td >{{env('CURRENCY')}}{{number_format($order->tax,2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Shipping Charge</td>
                                    <td >{{env('CURRENCY')}}{{number_format($order->shipping_charge,2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Discount</td>
                                    <td >{{env('CURRENCY')}}{{number_format($order->discount,2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td >{{env('CURRENCY')}}{{number_format(((($sub_total+$order->tax+$order->shipping_charge)-$order->discount)),2)}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>