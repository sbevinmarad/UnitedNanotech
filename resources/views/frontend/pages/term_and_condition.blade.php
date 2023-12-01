@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Term and Condition</span>
    <h1>Term and Condition</h1>
    </div>
</div>


 <div class="page-banne-text">
    <div class="container">
        <div class="row">
            {!! $cms->description !!}
        </div>
   
    
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection