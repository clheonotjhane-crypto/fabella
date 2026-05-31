@extends('layouts.main')

@section('title', 'Login - Product List')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-white text-center" style="background-color: rgb(52, 72, 93);">
                    <h4>Login</h4>
                </div>
                <div class="card-body p-4">
                    <form action="/login" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn text-white w-100" style="background-color: rgb(52, 72, 93);">Login</button>
                    </form>   <div class="text-center mt-3">
                        <span>Doesn't have an account?</span>
                        <a href="{{ route('register') }}" style="color: rgb(52, 72, 93); text-decoration: none; font-weight: 500;">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection