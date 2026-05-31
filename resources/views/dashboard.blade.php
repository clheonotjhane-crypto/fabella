@extends('layouts.main')

@section('title', 'Dashboard - Product List')

@section('content')
@php
$userId = session('user_id');
$userCount = \App\Models\User::count();
$productCount = \App\Models\Product::count();
$myProducts = \App\Models\Product::where('user_id', $userId)->count();
$otherProducts = \App\Models\Product::where('user_id', '!=', $userId)->count();
@endphp

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
<main style="flex: 1; margin-left: 2%; margin-top: 60px; padding: 1.5rem;">
    
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-purple border-0 rounded-4">
                <div class="card-body">
                    <small class="text-uppercase">Total Users</small>
                    <h2 class="mb-0">{{ $userCount }}</h2>
                    <i class="bi bi-people-fill position-absolute end-0 bottom-0 m-3 opacity-25" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-green border-0 rounded-4">
                <div class="card-body">
                    <small class="text-uppercase">My Products</small>
                    <h2 class="mb-0">{{ $myProducts }}</h2>
                    <i class="bi bi-box-seam position-absolute end-0 bottom-0 m-3 opacity-25" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-blue border-0 rounded-4">
                <div class="card-body position-relative">
                    <small class="text-uppercase">Total Products</small>
                    <h2 class="mb-0">{{ $productCount }}</h2>
                    <i class="bi bi-grid position-absolute end-0 bottom-0 m-3 opacity-25" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-3">
                    <i class="bi bi-bar-chart-line text-primary"></i> <strong>Users Overview</strong>
                    <span class="badge bg-light text-dark float-end">Live Data</span>
                </div>
                <div class="card-body">
                    <canvas id="userChart" height="230"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-3">
                    <i class="bi bi-pie-chart text-success"></i> <strong>My Products Distribution</strong>
                    <span class="badge bg-light text-dark float-end">Real-time</span>
                </div>
                <div class="card-body">
    <div style="height: 424px; position: relative;">
        <canvas id="productChart"></canvas>
    </div>
</div>
            </div>
        </div>
    </div>
</main>
<!-- Toast Notifications -->
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
    <div class="toast show align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
    <div class="toast show align-items-center text-white bg-danger border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    // Auto-hide toast messages after 3 seconds
    setTimeout(function() {
        var toasts = document.querySelectorAll('.toast');
        for (var i = 0; i < toasts.length; i++) {
            toasts[i].classList.remove('show');
        }
    }, 3000);
    
    // User chart
    var userCtx = document.getElementById('userChart');
    new Chart(userCtx, {
        type: 'bar',
        data: {
            labels: ['Total Users', 'Total Products'],
            datasets: [{
                data: [{{ $userCount }}, {{ $productCount }}],
                backgroundColor: ['#667eea', '#38ef7d']
            }]
        }
    });

    // Product chart
    var productCtx = document.getElementById('productChart');
    new Chart(productCtx, {
        type: 'doughnut',
        data: {
            labels: ['My Products', 'Others'],
            datasets: [{
                data: [{{ $myProducts }}, {{ $otherProducts }}],
                backgroundColor: ['#11998e', '#e2e8f0']
            }]
        }
    });
</script>
@endpush
@endsection