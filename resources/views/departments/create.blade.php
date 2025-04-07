@extends('layouts.layout')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="container mt-4">
            <h5 class="mb-3">Add Department</h5>

            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="department_name" class="form-label">Department Name <span class="text-danger">*</span></label>
                    <input type="text" name="department_name" class="form-control" value="{{ old('department_name') }}" required>
                    @error('department_name') 
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-save"></i> Save
                    </button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
