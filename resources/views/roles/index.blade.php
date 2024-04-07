@extends('layouts.main')

@section('content')
    <h1>Liste des roles</h1>

    @foreach ($roles as $role)
        <div>
            <h2>{{ $role->name }}</h2>
            <p>{{ $role->description }}</p>

            <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?')">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>

        </div>
    @endforeach
@endsection
