<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{{ config('app.name', 'Wild Spice Indian Restaurant') }}</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Raleway" rel="stylesheet">
<style>
body{
  font-family: 'Open Sans', sans-serif;
  color:#333;
  font-size:14px;
  
}
​
</style>
</head>
<body>
​@php
    $logo = \App\Models\Setting::first();
@endphp
<div style="width:625px; margin:0 auto; display:table; border:1px solid #999;  ">
    <div style="width:100%; padding:20px 0; float:left; text-align:center;background: #e4e4e4;">
        <a href="#"><img src="{{asset('storage/app/public/'.@$logo->logo) }}"></a>
    </div>
    
    <div style=" padding:10px; float:left; width:100%;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          
          <tr>
            <td style="padding:8px 5px; font-size:13px;" width="26%"> Product Enquery Details :</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">UserName : {{$booking->name}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Phone : {{$booking->phone}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Email : {{$booking->email}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Request Date : {{date('d M, Y', strtotime($booking->created_at))}} </td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Product name :  {{$booking->product_name}}</td>
          </tr>
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Quantity : {{$booking->quantity}} {{$booking->unit}}</td>
          </tr>

          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Purpose of Requirement : {{$booking->purpose}}</td>
          </tr>

          
          <tr>
            <td style="padding:8px 5px; font-size:10px;" width="26%">Requirement Details : {{$booking->description}}</td>
          </tr>
        </table>           
    </div>
    
    ​
</div>
​
​
</body>
</html>