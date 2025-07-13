@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #e3f2fd, #bbdefb);
        font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 420px;
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-header {
        background: linear-gradient(135deg, #1e88e5, #42a5f5);
        color: white;
        padding: 20px;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #ccc;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #1976d2;
        box-shadow: 0 0 0 0.15rem rgba(25, 118, 210, 0.25);
    }

    .btn-login {
        background-color: #1976d2;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 15px;
        width: 100%;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .btn-login:hover {
        background-color: #0d47a1;
        transform: scale(1.03);
    }

    .form-check-label {
        font-size: 14px;
    }

    .forgot-link {
        font-size: 14px;
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .text-danger {
        font-size: 13px;
    }
</style>

<div class="container login-container">
    <div class="login-card">
        <div class="login-header">
            🔐 LOGIN
        </div>

        <div class="card-body p-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">📧 Email</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">🔑 Password</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div

                <div class="d-grid">
                    <button type="submit" class="btn btn-login">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
