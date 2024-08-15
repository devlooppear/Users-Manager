@extends('index')

@section('title', 'Home')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-70 mt-5">
        <div class="card text-center p-4" style="max-width: 600px; width: 100%;">
            <div class="card-body">
                <h1 class="card-title">Welcome to the Home Page!</h1>
                <h2 class="card-subtitle mb-3 text-muted">This is the User Manager App</h2>
                <p class="card-text mb-4">Here is where you can manage your users.</p>
                <a href="/users" class="btn btn-primary">Check Users</a>
            </div>
        </div>
    </div>
@endsection
