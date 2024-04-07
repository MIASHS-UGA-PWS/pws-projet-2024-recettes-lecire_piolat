@extends('layouts.main')

@section('content')
    <h1>Create Role</h1>

    <form action="{{ route('roles.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Role</button>
    </form>
@endsection
