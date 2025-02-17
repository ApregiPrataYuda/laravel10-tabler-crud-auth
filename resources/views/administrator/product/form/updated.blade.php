
@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                   Page Form
                </div>
                <h2 class="page-title">
                    {{ $title }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <a href="{{ route('Administrator.products') }}" class="page-pretitle">
                    <i class="fa fa-home"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card w-100"> <!-- Card tetap lebar -->
            <div class="card-header">
                <h3 class="card-title text-center"> {{ $title }} </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('Administrator.update.product', $id) }}" class="mx-auto col-md-6">
                    @csrf
                    @method('PUT')
                    
    
                    <div class="mb-3">
                        <label class="form-label">Name Product**</label>
                        <input type="text" class="form-control" value="{{ $row->name_product }}" name="name_product">
                        @error('name_product')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_category" class="form-label">Catergory Product**</label>
                        <select class="form-select" id="id_category" name="id_category">
                            <option value="">-SELECT-</option>
                           @foreach ($category as $item)
                           <option class="text-uppercase" value="{{ $item->id_category }}" 
                               {{ old('id_category', $row->id_category) == $item->id_category ? 'selected' : '' }}>
                               {{ $item->name_category }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_category')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label">Description Product**</label>
                        <textarea class="form-control" name="description_product" rows="8">{{ $row->description_product  }}</textarea>
                        @error('description_product')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-azure"><i class="fa fa-save"> Save</i></button>
                        <button type="reset" class="btn btn-outline-orange"><i class="fa fa-undo"> Reset</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#id_category").select2({
           placeholder: "SELECT A CATEGORY",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });
</script>
@endsection
