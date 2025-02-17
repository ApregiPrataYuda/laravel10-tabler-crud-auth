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
        <div class="container-xl">
            <div class="row g-3">
                <!-- Card Kiri -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Kiri</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="Enter first name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card Kanan -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Kanan</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" placeholder="Enter last name">
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                        <option value="guest">Guest</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" rows="3" placeholder="Additional notes"></textarea>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



@endsection