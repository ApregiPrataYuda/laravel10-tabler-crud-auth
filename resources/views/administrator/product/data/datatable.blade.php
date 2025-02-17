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
      
        <a href="#" class="btn btn-pill btn-outline-teal">
         <i class="fa fa-file-excel"> Report </i>
           
        </a>
            
            <a href="{{ route('Administrator.add.product') }}" class="btn btn-pill btn-outline-azure">
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
            <table class="table card-table table-vcenter text-nowrap" id="ProductTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Name Product</th>
                        <th>Name Category</th>
                        <th>Description Product</th>
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
<meta name="route-product-get" content="{{ route('Administrator.products.get') }}">
@vite('resources/js/resource/js/product.js')
@endsection
		