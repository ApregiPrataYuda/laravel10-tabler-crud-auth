
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
                <a href="{{ route('Administrator.category') }}" class="page-pretitle">
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
                <form method="POST" action="{{ route('Administrator.save.category') }}" class="mx-auto col-md-6">
                    @csrf
                    
    
                    <div class="mb-3">
                        <label class="form-label">Name Category**</label>
                        <input type="text" class="form-control" value="{{ old('name_category') }}" name="name_category">
                        @error('name_category')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label">Description Category**</label>
                        <textarea class="form-control" name="description_category" rows="8">{{ old('description_category') }}</textarea>
                        @error('description_category')
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
@endsection
