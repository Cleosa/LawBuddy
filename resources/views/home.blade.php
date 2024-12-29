@extends('layouts.home')

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Fixed Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand fw-bold text-success">LAW<span class="text-primary">BUDDY</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('lawyer') ? 'active' : '' }}" href="{{ route('lawyer') }}">Lawyer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('chatbot.index') ? 'active' : '' }}" href="{{ route('chatbot.index') }}">Chatbot</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="GET" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="container mt-5 pt-5 text-center">
    <div class="mt-5">
        <h1 class="display-5 fw-bold text-success">Selamat Datang di <span class="text-primary">LawBuddy</span></h1>
        <p class="lead">Mari mulai konsultasi hukum Anda dengan mudah dan cepat.</p>
        <a href="{{ route('chatbot.index') }}" class="btn btn-success btn-lg">Mulai Konsultasi</a>
    </div>
    <div class="mt-4">
        <img src="{{ asset('images/hero.png') }}" alt="Ilustrasi solusi hukum" class="img-fluid" style="max-width: 500px;">
    </div>
</section>

<!-- Firma Hukum Kami -->
<section class="mt-5">
    <h2 class="text-center mb-4">Firma Hukum Kami</h2>
    <div class="d-flex justify-content-center flex-wrap">
        <img src="{{ asset('images/law-firm-1.png') }}" alt="Firma Hukum 1" class="img-thumbnail mx-2" style="max-width: 200px;">
        <img src="{{ asset('images/law-firm-2.png') }}" alt="Firma Hukum 2" class="img-thumbnail mx-2" style="max-width: 200px;">
        <img src="{{ asset('images/law-firm-3.png') }}" alt="Firma Hukum 3" class="img-thumbnail mx-2" style="max-width: 200px;">
        <img src="{{ asset('images/law-firm-4.png') }}" alt="Firma Hukum 4" class="img-thumbnail mx-2" style="max-width: 200px;">
    </div>
</section>

<!-- Layanan Kami -->
<section class="mt-5 text-center">
    <h2 class="mb-4">Layanan Yang Tersedia</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Konsultasi Online</h5>
                    <p class="card-text">Dapatkan konsultasi langsung dengan chatbot AI kami yang siap membantu 24/7.</p>
                    <a href="{{ route('chatbot.index') }}" class="btn btn-outline-success">Mulai Chat</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Konsultasi Lawyer</h5>
                    <p class="card-text">Terhubung dengan pengacara berpengalaman untuk masalah hukum yang lebih kompleks.</p>
                    <a href="{{ route('lawyer') }}" class="btn btn-outline-success">Cari Lawyer</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Riwayat Konsultasi</h5>
                    <p class="card-text">Akses riwayat konsultasi Anda kapan saja di dashboard pribadi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Artikel dan Blog -->
<section class="mt-5">
    <h4 class="text-center mb-4">Artikel Terbaru</h4>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('images/article-1.png') }}" class="card-img-top" alt="Artikel Teknologi">
                <div class="card-body">
                    <h5 class="card-title">Peran Teknologi Mempermudah Akses Keadilan</h5>
                    <p class="card-text">Harapan atau Tantangan?</p>
                    <a href="#" class="text-success">Baca lebih lengkap →</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('images/article-2.png') }}" class="card-img-top" alt="Artikel Privasi">
                <div class="card-body">
                    <h5 class="card-title">Hak atas Privasi vs. Keamanan Publik</h5>
                    <p class="card-text">Dimana Garis Batasnya?</p>
                    <a href="#" class="text-success">Baca lebih lengkap →</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ asset('images/article-3.png') }}" class="card-img-top" alt="Artikel Konsumen">
                <div class="card-body">
                    <h5 class="card-title">Hukum Perlindungan Konsumen di Era Digital</h5>
                    <p class="card-text">Apakah Sudah Memadai?</p>
                    <a href="#" class="text-success">Baca lebih lengkap →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-light mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>LawBuddy</h5>
                <p>&copy; 2024 All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-light mx-2">Privacy Policy</a>
                <a href="#" class="text-light mx-2">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

@endsection