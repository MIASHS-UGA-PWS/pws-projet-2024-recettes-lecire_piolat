@extends('layouts.main')

@section('content')
    <h1>Edit Role</h1>

    <form action="{{ route('admin.roles.update', $role) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $role->name }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
@endsection
