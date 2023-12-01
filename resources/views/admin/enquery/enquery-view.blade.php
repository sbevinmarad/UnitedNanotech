<x-admin-layout title="Product Enquery Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Product Enquery View">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('enqueires.index') }}" value="Product Enquery List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('enqueires.index')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                    Product Enquery Details
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
                                    <th scope="row" style="width: 250px;">User Name</th>
                                    <td>{{ $enquery->name}}</td>
                                </tr>

                                <tr>
                                    <th scope="row" >User Email</th>
                                    <td>{{ $enquery->email}}</td>
                                </tr>

                                <tr>
                                    <th scope="row" >User Phone No</th>
                                    <td>{{ $enquery->phone}}</td>
                                </tr>

                                <tr>
                                    <th scope="row" >Product Name</th>
                                    <td>{{ $enquery->product_name}}</td>
                                </tr>

                                <tr>
                                    <th scope="row" >Quantity</th>
                                    <td>{{ $enquery->quantity}} {{ $enquery->unit}}</td>
                                </tr>

                                <tr>
                                    <th scope="row" >Request Date</th>
                                    <td>{{date('d M, Y', strtotime($enquery->created_at))}}</td>
                                </tr>

                                

                                <tr>
                                    <th scope="row" >Purpose of Requirement</th>
                                    <td>{{ $enquery->purpose}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Requirement Details</th>
                                    <td>{{$enquery->description}}</td>
                                </tr>

                                

                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>