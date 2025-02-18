
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
                <form  action="{{ route('Administrator.update.price.product', $id) }}" method="POST" class="mx-auto col-md-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Product Price**</label>
                        <input type="text" class="form-control" id="price" name="prices" value="{{ $row->price }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Select Product**  </label>
                        <select class="form-select" id="product_id" name="product_id" disabled>
                            {{-- <option value=""></option> --}}
                            @foreach ($product as $item)
                           <option class="text-uppercase" value="{{ $item->id_product }}"  readonly
                               {{ old('product_id', $row->product_id) == $item->id_product ? 'selected' : '' }}>
                               {{ $item->name_product }}
                            </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="product_id" value="{{ $row->product_id }}">
                    </div>
                    
                  
                    
                    <div class="mb-3">
                        <label class="form-label">Start Date Price**</label>
                        <span class="font-italic text-primary">
                            Date Price Berlaku Dimulai: {{ format_date_indonesia_old($row->start_date) }}
                        </span>
                        <input type="date" class="form-control" name="start_date" 
                            value="{{ old('start_date', $row->start_date) }}">
                        @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="mb-3">
                        <label class="form-label">End Date Price <small>(opsional)</small></label>
                        <span class="font-italic text-primary">Date Price Berlaku Di Akhiri: {{ $row->end_date ? format_date_indonesia_old($row->end_date) : 'Tidak ada Tanggal Berlaku';  }}</span>
                        <input type="date" class="form-control" value="{{ old('end_date') }}" name="end_date">
                        @error('end_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-azure"><i class="fa fa-save"> Update</i></button>
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
           placeholder: "TIDAK BISA DI EDIT",
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
