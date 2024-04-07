@extends('layouts.main')

@section('content')
    <h1>Role Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $role->name }}</h5>
        </div>
    </div>
    <a href="{{ route('roles.index') }}" class="btn btn-primary">Back to Roles
    </a>
@endsection
