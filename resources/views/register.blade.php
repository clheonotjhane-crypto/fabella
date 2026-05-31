@extends('layouts.main')

@section('title', 'Register - Product List')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white text-center" style="background-color: rgb(52, 72, 93);">
                    <h4>Sign Up</h4>
                </div>
                <div class="card-body p-4">
                    <p class="text-center text-muted mb-4">Create your account by filling in the details below</p>

                    <form action="/register" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mb-3">Register</button>
                        
                        <div class="text-center">
                            <a href="{{ route('login') }}" style="color: black;">Already have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection