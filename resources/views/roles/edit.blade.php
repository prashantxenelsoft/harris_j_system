@extends('layouts.layout')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="container mt-4">
            <h4 class="mb-3">Edit Role</h4> <!-- Smaller Heading -->

            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="name" value="{{ $role->name }}" class="form-control form-control-sm" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <h6 class="mt-4 mb-2">Menus Permissions</h6> <!-- Smaller Subheading -->

                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 60%;">Menu Title</th>
                            <th style="width: 15%;">
                                <input type="checkbox" id="select-all-view"> View
                            </th>
                            <th style="width: 15%;">
                                <input type="checkbox" id="select-all-edit"> Edit
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $key => $menu)
                            @php
                                $perm = $permissions->where('menu_id', $menu->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $menu->heading }}</td>
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input view-checkbox"
                                        name="permissions[{{ $menu->id }}][view]" value="1"
                                        {{ isset($perm) && $perm->can_view ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input edit-checkbox"
                                        name="permissions[{{ $menu->id }}][edit]" value="1"
                                        {{ isset($perm) && $perm->can_edit ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Select All Script --}}
                <script>
                    document.getElementById('select-all-view').addEventListener('change', function () {
                        document.querySelectorAll('.view-checkbox').forEach(cb => cb.checked = this.checked);
                    });
                    document.getElementById('select-all-edit').addEventListener('change', function () {
                        document.querySelectorAll('.edit-checkbox').forEach(cb => cb.checked = this.checked);
                    });
                </script>

                <div class="mt-3">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
