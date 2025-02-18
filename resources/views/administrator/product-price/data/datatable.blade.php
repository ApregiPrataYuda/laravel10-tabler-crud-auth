@extends('layouts.app')
@section('content')


 <div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            {{ $title }}
        </div>
        <h2 class="page-title">
            {{ $title }}
        </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
      
        <a href="{{ route('Administrator.price.products.report.excel') }}" class="btn btn-pill btn-outline-teal btn-sm">
         <i class="fa fa-file-excel"> Report Excel</i>
        </a>

        <a href="{{ route('Administrator.price.products.report.pdf') }}" class="btn btn-pill btn-outline-red btn-sm">
            <i class="fa fa-file-pdf"> Report PDF</i>
           </a>

           <a href="{{ route('Administrator.price.products.report.csv') }}" class="btn btn-pill btn-outline-secondary btn-sm">
            <i class="fa fa-file-csv"> Report CSV</i>
           </a>
            
            <a href="{{ route('Administrator.add.product.price') }}" class="btn btn-pill btn-outline-azure">
             <i class="fa fa-plus"> Create </i>
               
            </a>
        </div>
        </div>
    </div>
    </div>
</div>


<div id="flash" data-flash="{{ session('success') }}"></div>
<div id="flashError" data-flash="{{ session('error') }}"></div>
<div id="flashInfo" data-flash="{{ session('info') }}"></div>

<div class="page-body">
<div class="container-xl">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Master {{ $title }}</h3>
        </div>
        <div class="table-responsive mb-4 p-3">
            <table class="table card-table table-vcenter text-nowrap" id="ProductPriceTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Name Product</th>
                        <th>Category Product</th>
                        <th>Price</th>
                        <th>Price start date </th>
                        <th>Price start end </th>
                        <th>Product Description </th>
                        <th style="width: 3%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<meta name="route-product-price-get" content="{{ route('Administrator.price.get') }}">
@vite('resources/js/resource/js/productPrice.js')
@endsection
		