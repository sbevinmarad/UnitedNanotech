@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" @if(isset($banner) && isset($banner->banner)) style="background-image: url('{{asset('storage/app/public/'.$banner->banner)}}')" @else style="background-image: url({{asset('public/assets/images/inner_header.jpg')}});" @endif>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2>Shopping Cart</h2>
                    <div class="pageBannerPath">
                        <a href="{{route('home')}}">Home</a>&nbsp;&nbsp; / &nbsp;&nbsp;<span>Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->



<!-- END: Cart Page Section -->
<livewire:frontend.cart.cart-edit />
         
<!-- END: Cart Page Section -->


@endsection

@section('script')
<script type="text/javascript">


</script>
@endsection