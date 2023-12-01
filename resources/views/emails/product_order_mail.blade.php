<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ config('app.name', 'Future style barbers') }}</title>

<style>
  table td{
    border: 1px solid #ccc;
  }



</style>
</head>
<body>

 <div style="background-color: #f2f2f2; padding-top: 25px; width: 600px; margin:0px auto;">  
  <div style="padding-left: 15px; padding-right: 15px;">  
 <div style="padding-bottom: 20px; background: #0b6623;"><img style="display: block;margin-left: auto;margin-right: auto;" src="{{asset('storage/app/public/'.@$setting->logo) }}" alt="logo"></div>
  <p style="font-family: arial; font-size: 25px; color: #000; margin-bottom: 30px; text-align: center;"></p>
   <table width="100%"   cellpadding="0" cellspacing="0">
     <tr>
       <td style=" width: 50%; padding: 8px; ">
         <p style="font-family: arial; font-size: 14px; color: #000;">Hi {{$order->customer_name}}, <p>
       </td>
       <td style="text-align: right;  width: 50%; padding: 8px;">
         <span style="width: 100%; float: left; text-align: right;font-family: arial; font-size: 14px; color: #000;">Order ID : {{$order->r_order_id}}</span>
         <span style="width: 100%; float: left; text-align: right;font-family: arial; font-size: 14px; color: #000;">Order Date : {{$order->created_at->format('d M, Y')}}</span>
       </td>
     </tr>
   </table>
   
   <p style="font-family: arial; font-size: 14px; color: #000; line-height: 1.7;"> 

   Your order has been placed successfully.</p>

    <table width="100%"  cellpadding="0" cellspacing="0">
  <tbody><tr style="background-color: #222; font-size: 12px; font-family: arial; color: #fff;padding-bottom: 12px;
    padding-top: 12px;">
    <td style="font-size: 15px;padding-left: 10px;padding-top: 10px; padding-bottom: 10px;">Your Details</td>
     <td style="font-size: 15px;padding-left: 10px;padding-top: 10px; padding-bottom: 10px;">Your Address</td>
      
  </tr>
  <tr style="background-color: #d9d9d9;">
  
    <td style="font-size: 18px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;"> <strong>{{$order->customer_name}}</strong></td>
       <td style="font-size: 18px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;"><strong>{{$order->address}} {{$order->road}} {{$order->city}} {{$order->district}} {{$order->state?$order->state->state:""}} </strong></td>
 
  </tr>
 
  <tr style="background-color: #d9d9d9;">
   
    <td style="font-size: 15px; font-family: arial; color: #000; background-color: #d9d9d9; padding-bottom: 5px;padding-left: 13px; padding-top: 5px;">Moble No: {{$order->customer_phone}}</td>
     <td style="font-size: 15px; font-family: arial; color: #000; background-color: #d9d9d9; padding-bottom: 5px;padding-left: 13px; padding-top: 5px;">Pin Code: <span>{{$order->pin_code}}</span></td>
     
   
  </tr>
  
</tbody></table>

  <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
  <tbody>
    <tr style="background-color: #222; font-size: 12px; font-family: arial; color: #fff;padding-bottom: 12px;padding-top: 12px;">
    <td style="font-size: 15px;padding-left: 10px;padding-top: 10px; padding-bottom: 10px;">Product Name</td>
    <!-- <td style="font-size: 15px;padding-left: 10px;padding-top: 10px; padding-bottom: 10px;">Product Size</td> -->
     <td style="font-size: 15px;padding-left: 10px;padding-top: 10px; padding-bottom: 10px;">Quantity</td>
     <td style="font-size: 15px;padding-left: 10px;padding-top: 10px; padding-bottom: 10px;">Price</td>
     <td style="font-size: 15px;padding-left: 10px;padding-top: 10px; padding-bottom: 10px;">Total Price</td>
     <td style="font-size: 15px;padding-left: 10px;padding-top: 10px; padding-bottom: 10px;">Total GST</td>
  </tr>



@php
    $sub_total = 0;
    $tax = 0;
@endphp
@if(count($order->order_details)>0)
@foreach($order->order_details as $details)
@php
    $sub_total+= ($details->quantity*$details->price);
@endphp
  <tr style="background-color: #f2f2f2;">
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">{{$details->product_name}}
    </td>
    <!-- <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">{{$details->size}}
    </td> -->
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">{{$details->quantity}}</td>
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">{{env('CURRENCY', '₹')}}{{number_format($details->price,2)}}</td>
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">{{env('CURRENCY', '₹')}}{{number_format($details->total,2)}}</td>
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">{{env('CURRENCY', '₹')}}{{number_format($details->total_gst,2)}}</td>
  </tr>
@endforeach
@endif

  <tr style="background-color: #f2f2f2;">
  
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;" colspan="3" rowspan="5">&nbsp;</td>
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">Subtotal</td>
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;"><b>{{env('CURRENCY', '₹')}}{{number_format($sub_total,2)}}</b></td>
  </tr>

  <tr style="background-color: #f2f2f2;">
  
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">Shipping Charge</td>
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;"><b>{{env('CURRENCY', '₹')}}{{number_format($order->shipping_charge,2)}}</b></td>
  </tr>
  <tr style="background-color: #f2f2f2;">
  
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">Total GST</td>
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;"><b>{{env('CURRENCY', '₹')}}{{number_format($order->tax,2)}}</b></td>
  </tr>

@if(isset($order->discount))
  <tr style="background-color: #f2f2f2;">
  
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;">Discount</td>
    <td style="font-size: 15px;font-family: arial;color: #000;padding-top: 5px;padding-bottom: 5px;padding-left: 13px;"><b>{{env('CURRENCY', '₹')}}{{number_format($order->discount,2)}}</b></td>
  </tr>
  @endif
  
  <tr style="background-color: #f2f2f2;">
    <td style="font-size: 17px;font-family: arial;color: #fff;padding-top: 5px;padding-bottom: 5px;padding-left: 13px; background-color: #222;">Total</td>
    <td style="font-size: 17px;font-family: arial;color: #fff;padding-top: 5px;padding-bottom: 5px;padding-left: 13px; background-color: #222;"><b>{{env('CURRENCY', '₹')}}{{number_format(((($sub_total+$order->tax+$order->shipping_charge)-$order->discount)),2)}}</b></td>
  </tr> 
</tbody></table>
      

   

    <p style="font-size: 14px; font-family: arial; color: #000; font-size: 14px; color: #000; margin-top: 30px; text-align: left; line-height: 1.7;">Thanks & Regards,<br>
  {{ config('app.name', 'Future style barbers') }}<br>
       </p>
    </div>   
   
   <div style="background-color: #696969; padding-top: 15px; padding-bottom: 15px; padding-left: 35px; padding-right: 35px;">
    

    <p style="font-size: 14px; font-size: 14px; color: #fff; text-align: center;font-family: arial;">Copyright © <?php echo date('Y'); ?> {{ config('app.name', 'Future style barbers') }}. All Rights Reserved.</p>
   </div>

 </div>   


</body>
</html>