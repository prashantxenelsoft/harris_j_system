@extends('layouts.layout')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="container mt-4">
            <h5 class="mb-3">Edit Designation</h5>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('designations.update', $designation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="designation_name" class="form-label">Designation Name <span class="text-danger">*</span></label>
                    <input type="text" name="designation_name" class="form-control" value="{{ old('designation_name', $designation->designation_name) }}" required>
                    @error('designation_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-repeat"></i> Update
                    </button>
                    <a href="{{ route('designations.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
