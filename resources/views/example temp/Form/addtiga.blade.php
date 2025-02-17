@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Form Example
        </h2>
        <p class="text-muted">
          A simple form using Tabler components
        </p>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Registration Form</h3>
          </div>
            <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Company -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Company</label>
                                <input type="text" class="form-control" value="Creative Code Inc." readonly>
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="michael23">
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" value="Email" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="Chet">
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="Faker">
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="Melbourne, Australia">
                    </div>

                    <div class="row">
                        <!-- City -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" name="city" value="Melbourne">
                            </div>
                        </div>

                        <!-- Postal Code -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Postal Code</label>
                                <input type="text" class="form-control" name="postal_code" placeholder="ZIP Code">
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select class="form-select" name="country">
                                    <option selected>Germany</option>
                                    <option>Australia</option>
                                    <option>United States</option>
                                    <option>Canada</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- About Me -->
                    <div class="mb-3">
                        <label class="form-label">About Me</label>
                        <textarea class="form-control" name="about_me" rows="4">Oh so, your weak rhyme
You doubt I'll bother, reading into it
I'll probably won't, left to my own devices
But that's the difference in our opinions
</textarea>
</div>

<!-- Submit Button -->
<div class="text-end">
    <button type="submit" class="btn btn-primary">Update Profile</button>
</div>

</form>
</div>
</div>
</div>
</div>


@endsection