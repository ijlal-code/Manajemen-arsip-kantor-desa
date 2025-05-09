@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Login</h2>
    @if($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Login</button>
       
    </form>
</div>
@endsection
