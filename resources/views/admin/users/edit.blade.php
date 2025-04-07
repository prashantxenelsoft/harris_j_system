@extends('layouts.layout')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Edit User</h5>
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </div>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $user->name) }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', $user->email) }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-sm" placeholder="Leave blank to keep current password">
                    <small class="text-muted">Enter only if you want to change the password.</small>
                    @error('password') <small class="text-danger d-block">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select form-select-sm" required>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select form-select-sm" required>
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="deactive" {{ $user->status == 'deactive' ? 'selected' : '' }}>Deactive</option>
                    </select>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="bi bi-save"></i> Update User
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
