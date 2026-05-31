@extends('layouts.main')

@section('title', 'Profile - Product List')

@section('content')

<!-- Logo Area -->
<div style="position: fixed; top: 0; left: 0; width: 16.666%; height: 60px; background-color: #e8e8e8; display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 1001; border-bottom: 1px solid #ccc;">
    <h5 style="font-weight: bold; margin-bottom: 0;">PRODUCT LIST</h5>
    <small style="color: #6c757d;">Management</small>
</div>

<!-- Curved Navbar -->
<nav style="height: 60px; background-color: #e8e8e8; border-bottom: 1px solid #ccc; position: fixed; top: 0; right: 0; left: 16.666%; z-index: 1000; display: flex; align-items: center; padding: 0 1.5rem;">
    <span style="font-weight: bold; color: #212529;"></span>
    
    <div style="display: flex; align-items: center; gap: 0.75rem; margin-left: auto;">
        <div style="width: 35px; height: 35px; background-color: #6c757d; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 500;">
            {{ substr(\App\Models\User::find(session('user_id'))->name ?? 'G', 0, 1) }}
        </div>
        <span style="font-weight: 500;">{{ \App\Models\User::find(session('user_id'))->name ?? 'Guest' }}</span>
        <a href="{{ route('profile') }}" class="btn btn-sm btn-outline-secondary ms-2">Profile</a>
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-danger ms-1">Logout</a>
    </div>
</nav>

<div style="display: flex; min-height: 100vh; background: #f8f9fa;">
    <!-- Curved Sidebar -->
    <nav style="width: 16.666%; background-color: #e8e8e8; position: relative; padding: 2rem 1rem; margin-top: 60px;">
        <!-- Curve connector -->
        <div style="content: ''; position: absolute; top: -60px; left: 0; width: 100%; height: 60px; background-color: #e8e8e8; border-top-right-radius: 30px;"></div>
        
        <ul style="display: flex; flex-direction: column; padding-left: 0; margin-bottom: 0; list-style: none; margin-top: 0.5rem;">
            <li style="margin-bottom: 0.5rem;">
                <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; color: #333; text-decoration: none; border-radius: 0.5rem; background-color: white; font-weight: 500;">
                    <i class="bi bi-grid" style="margin-right: 0.75rem; font-size: 1.1rem;"></i> Dashboard
                </a>
            </li>
            <li style="margin-bottom: 0.5rem;">
                <a href="{{ route('users') }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; color: #333; text-decoration: none; border-radius: 0.5rem; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#d0d0d0'" onmouseout="this.style.backgroundColor='transparent'">
                    <i class="bi bi-people" style="margin-right: 0.75rem; font-size: 1.1rem;"></i> Users
                </a>
            </li>
            <li style="margin-bottom: 0.5rem;">
                <a href="{{ route('products') }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; color: #333; text-decoration: none; border-radius: 0.5rem; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#d0d0d0'" onmouseout="this.style.backgroundColor='transparent'">
                    <i class="bi bi-box-seam" style="margin-right: 0.75rem; font-size: 1.1rem;"></i> My Products
                </a>
            </li>
        </ul>
    </nav>

        <!-- Main Content -->
        <main class="col-md-10 p-4">
            <br><br>
            <h2 class="mb-4">My Profile</h2>

            <div class="row">
                <div class="col-md-6" style="max-width: 900px;">
                    <div class="card">
                        <div class="card-header">
                            <h5>Profile Information</h5>
                        </div>
                       <div class="card-body">
    @php $user = \App\Models\User::find(session('user_id')); @endphp
    
    <!-- Profile Picture Display -->
    <div class="text-center mb-4">
        @if($user->profile_picture)
            <img src="{{ asset('uploads/' . $user->profile_picture) }}" 
                 class="rounded-circle" width="300" height="150" alt="Profile">
        @else
            <img src="https://via.placeholder.com/150" 
                 class="rounded-circle" width="300" height="150" alt="Profile">
        @endif
    </div>

    <hr>

    <!-- Form 2: Upload Picture Only -->
    <form action="/profile/picture" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" name="profile_picture" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-camera"></i> Upload Picture
        </button>
    </form>

    <!-- Form 1: Update Info Only -->
    <form action="/profile/update" method="POST" class="mb-4">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class=""></i> Update Info
        </button>
    </form>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection