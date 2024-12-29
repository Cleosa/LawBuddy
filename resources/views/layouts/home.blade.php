<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LawBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e5f6f1;
            /* Light green background */
        }

        .container {
            margin-top: 100px;
        }

        .btn-masuk {
            background-color: #198754;
            color: #E6E69D !important;
        }

        .nav-link {
            color: #70736F;
        }

        .nav-link:hover {
            background-color: #B7ECAA;
            color: #393B38 !important;
            transition: background-color 0.5s, transform 0.5s;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>