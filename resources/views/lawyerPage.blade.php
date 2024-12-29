<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Lawyer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e5f6f1;
        }

        .container {
            margin-top: 100px;
        }

        footer {
            margin-bottom: 0px;
        }
    </style>
</head>

<body>
    <!-- Fixed Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm" style="padding: 0;">
        <div class="container-fluid d-flex align-items-center">
            <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">LAW<span
                    class="text-primary">BUDDY</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('homePage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('lawyer') }}">Lawyer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chatbot.index') }}">Chatbot</a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('login') }}" class="nav-link btn-masuk ms-3">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Contact Lawyer Section -->
    <section class="container mt-5 pt-5">
        <div class="text-center">
            <h1 class="display-5 fw-bold text-success">Hubungi Pengacara Kami</h1>
            <p class="lead">Temukan pengacara terbaik untuk kebutuhan hukum Anda dengan mudah.</p>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered">
                <thead class="table-success">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Pengalaman (Tahun)</th>
                        <th scope="col">Fee (IDR)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lawyers as $lawyer)
                    <tr>
                        <td>{{ $lawyer->name }}</td>
                        <td>{{ $lawyer->phone_number }}</td>
                        <td>{{ $lawyer->years_of_experience }}</td>
                        <td>Rp{{ number_format($lawyer->consultation_fee, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data lawyer.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>