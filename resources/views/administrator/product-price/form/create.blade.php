
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
                <a href="{{ route('Administrator.price.products') }}" class="page-pretitle">
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
                <form method="POST" action="{{ route('Administrator.store.product.price') }}" class="mx-auto col-md-6">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Product Price**</label>
                        <input type="text" class="form-control" id="price" name="prices" value="{{ old('prices') }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Select Product**</label>
                        <select class="form-select" id="product_id" name="product_id">
                            <option value="">-SELECT-</option>
                            @foreach ($product as $item)
                           <option class="text-uppercase" value="{{ $item->id_product }}" 
                               {{ old('product_id') == $item->id_product ? 'selected' : '' }}>
                               {{ $item->name_product }}
                            </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label">Start Date Price**</label>
                        <input type="date" class="form-control" value="{{ old('start_date') }}" name="start_date">
                        @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">End Date Price <small>(opsional)</small></label>
                        <input type="date" class="form-control" value="{{ old('end_date') }}" name="end_date">
                        @error('end_date')
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
        $("#product_id").select2({
           placeholder: "SELECT A PRODUCT",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });

    $(document).ready(function(){
    $('#price').on('input', function(){
        let angka = $(this).val().replace(/[^,\d]/g, '');
        let numberString = angka.replace(/\D/g, '');
        let formattedNumber = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(numberString);

        $(this).val(formattedNumber.replace("Rp", "").trim());
    });
});
</script>
@endsection
