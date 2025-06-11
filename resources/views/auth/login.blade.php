@extends('layouts.app')

@section('content')
<div class="vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="card p-4 shadow-lg border-0 bg-white rounded-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center text-primary fw-bold mb-4">Login</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-3" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-3" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-semibold rounded-3">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
