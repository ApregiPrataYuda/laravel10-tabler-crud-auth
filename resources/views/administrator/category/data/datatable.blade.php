@extends('layouts.app')
@section('content')

 <!-- Page Header -->
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
            <a href="{{ route('Administrator.add.category') }}" class="btn btn-pill btn-outline-azure">
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
            <table class="table card-table table-vcenter text-nowrap" id="categoryTable">
                <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th>Name Category</th>
                        <th>Description Category</th>
                        <th style="width: 5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                         <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name_category }}</td>
                            <td>{{ $item->description_category }}</td>
                            <td>
                                <form action="{{ route('Administrator.edit.category') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ Crypt::encrypt($item->id_category) }}">
                                    <button type="submit" class="btn btn-pill btn-outline-orange">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </form>
                            
                                <form id="delete-form-{{ $item->id_category }}" action="{{ route('Administrator.delete.category', Crypt::encrypt($item->id_category)) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-pill btn-outline-red" onclick="confirmDelete('{{ $item->id_category }}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                
                            </td>
                         </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script>
	$(document).ready(function() {
    $('#categoryTable').DataTable();
});


function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
  </script>
  
    
@endsection
		