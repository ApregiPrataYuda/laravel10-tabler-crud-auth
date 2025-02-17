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
          <form>
            <!-- Full Name -->
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" placeholder="Enter your full name">
            </div>
  
            <!-- Email -->
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control" placeholder="Enter your email">
            </div>
  
            <!-- Password -->
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Enter your password">
            </div>
  
            <!-- Textarea -->
            <div class="mb-3">
              <label class="form-label">Address</label>
              <textarea class="form-control" rows="3" placeholder="Enter your address"></textarea>
            </div>
  
            <!-- Select -->
            <div class="mb-3">
              <label class="form-label">Gender</label>
              <select class="form-select">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
  
            <!-- Radio Buttons -->
            <div class="mb-3">
              <label class="form-label">Subscribe to Newsletter</label>
              <div>
                <label class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="subscribe" value="yes">
                  <span class="form-check-label">Yes</span>
                </label>
                <label class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="subscribe" value="no">
                  <span class="form-check-label">No</span>
                </label>
              </div>
            </div>
  
            <!-- Checkbox -->
            <div class="mb-3">
              <label class="form-check">
                <input class="form-check-input" type="checkbox">
                <span class="form-check-label">I agree to the terms and conditions</span>
              </label>
            </div>
  
            <!-- Submit Button -->
            <div class="form-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



@endsection