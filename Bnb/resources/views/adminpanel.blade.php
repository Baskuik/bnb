@extends('layout')

@section('title', 'Admin Panel')

@section('content')
    <div class="container">
        <h1>Adminpanel</h1>

        <!--checkt op success bericht in sessie. wnr dat zo is krijg je success berich-->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Nieuwe gebruiker</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Admin?</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <!--loop door alle users-->
                @foreach ($users as $user)
                    <tr>
                        <!--laat id, name, email en is_admin zien-->
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? '✔️' : '❌' }}</td>
                        <td>
                            <!--bewerk knop-->
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">Bewerk</a>
                            <!--verwijder knop-->
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijder</button>
                                <!--bekijk boekingen knop-->
                                <a href="{{ route('admin.users.boekingen', $user) }}" class="btn btn-info btn-sm">Bekijk boekingen</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
