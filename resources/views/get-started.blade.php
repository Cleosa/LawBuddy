@extends('layouts.app')

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
        <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">LAW<span class="text-primary">BUDDY</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('lawyer') ? 'active' : '' }}" href="{{ route('lawyer') }}">Lawyer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('chatbot.index') ? 'active' : '' }}" href="{{ route('chatbot.index') }}">Chatbot</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link btn-masuk ms-3">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="container mt-5 pt-5 text-center">
    <div class="mt-5">
        <h1 class="display-5 fw-bold text-success">Solusi cepat dan tepat atas masalah <span class="text-primary">Hukum</span> Anda</h1>
        <p class="lead">Butuh jawaban atas pertanyaan hukum? Chatbot kami hadir untuk membantu Anda.</p>
        <a href="{{ route('chatbot.index') }}" class="btn btn-success btn-lg">Mulai Chat</a>
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

<!-- Kenapa Harus Menggunakan Layanan Kami -->
<section class="mt-5 text-center">
    <h2 class="mb-4">Kenapa Harus Menggunakan Layanan Kami?</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Masyarakat Umum</h5>
                    <p class="card-text">Bingung dengan proses hukum? Dapatkan informasi profesional yang mudah dipahami.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Pengusaha dan Pemilik Bisnis</h5>
                    <p class="card-text">Lindungi bisnis Anda dengan pelayanan hukum yang tangguh serta perlindungan hukum untuk kekayaan pribadi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-success">Pekerja dan Karyawan</h5>
                    <p class="card-text">Pahami hak-hak Anda di tempat kerja, termasuk upah, kontrak, dan perlindungan hukum lainnya.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call-to-Action Section -->
<section class="mt-5 text-center">
    <h3 class="mb-3">Tunggu apa lagi? Daftar sekarang!</h3>
    <p>Daftarkan akun Anda sekarang dan dapatkan akses penuh ke semua fitur chatbot kami dengan cara mudah. Tidak ada biaya tersembunyi!</p>
    <a href="{{ route('login') }}" class="btn btn-success btn-lg">Daftar Sekarang</a>
</section>

<!-- Artikel dan Blog -->
<section class="mt-5">
    <h4 class="text-center mb-4">Keadilan adalah Fondasi Kepercayaan</h4>
    <p class="text-center mb-5">
        Blog LawBuddy adalah tempat terbaik untuk membaca wawasan terbaru tentang keadilan, privasi, dan teknologi AI. Temukan solusi yang berpusat pada komunitas, pelajari bagaimana komunitas kami telah berkembang bersama teknologi kami.
    </p>
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

<!-- Konsultasi Gratis -->
<section class="mt-5 text-center">
    <h3 class="mb-4">Mulai Konsultasi Gratis</h3>
    <a href="{{ route('chatbot.index') }}" class="btn btn-success btn-lg">Mulai Chat →</a>
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
