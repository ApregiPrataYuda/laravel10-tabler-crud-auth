@extends('layouts.app')
@section('content')

 <!-- Page Header -->
 <div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Overview
        </div>
        <h2 class="page-title">
            Table Data
        </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
        </span>
        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
         <i class="fa fa-file-excel"></i>
        Report  data
        </a>

            </span>
            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
             <i class="fa fa-plus"></i>
            Create new data
            </a>
        </div>
        </div>
    </div>
    </div>
</div>


<div class="page-body">
<div class="container-xl">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Invoices</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Invoice Subject</th>
                        <th>Client</th>
                        <th>VAT No.</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Row -->
                    <tr>
                        <td>1</td>
                        <td>Sample Invoice</td>
                        <td>Client Name</td>
                        <td>123456789</td>
                        <td>12 Feb 2025</td>
                        <td><span class="badge bg-success">Paid</span></td>
                        <td>$500</td>
                        <td>
                            <button class="btn btn-sm btn-warning mr-3">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection
		