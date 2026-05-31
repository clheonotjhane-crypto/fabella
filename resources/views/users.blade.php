@extends('layouts.main')

@section('title', 'Users - Product List')

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
                <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; color: #333; text-decoration: none; border-radius: 0.5rem; transition: background-color 0.2s;">
                    <i class="bi bi-grid" style="margin-right: 0.75rem; font-size: 1.1rem;"></i> Dashboard
                </a>
            </li>
            <li style="margin-bottom: 0.5rem;">
                <a href="{{ route('users') }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; color: #333; text-decoration: none; border-radius: 0.5rem; background-color: white; font-weight: 500;" onmouseover="this.style.backgroundColor='#d0d0d0'" onmouseout="this.style.backgroundColor='transparent'">
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

        
        <main class="col-md-10 p-4">
          <br><br>  <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>User Management</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-plus-circle"></i> Add User
                </button>
            </div>

            <!-- Users Table -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
<td>{{ $user->name }}</td>                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('users.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit User Modal -->
                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" name="fullname" class="form-control" value="{{ $user->fullname }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update User</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/users" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection