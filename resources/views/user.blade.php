@extends('formpanels.layoutForUser.app')

@section('title', 'Guest User')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 text-center" style="max-width: 400px;">
        <h2 class="mb-3">Selamat Datang!</h2>
        <p class="text-muted">Anda saat ini masuk sebagai <strong>guest</strong>.</p>
        <a href="{{ route('login') }}" class="btn btn-primary w-100">
            <i class="fa-solid fa-sign-in-alt"></i> Login jika anda adalah Admin.
        </a>
    </div>
</div>
@endsection
