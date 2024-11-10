<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Blog</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .border-container {
            border: 2px solid #000; /* Apply border to the entire container */
            padding: 20px; /* Add some space around the content */
        }
    </style>

    @stack('styles') <!-- Stack for additional styles from child views -->
    @yield('styles')
</head>

<body>
    <div class="container mt-5 border-container">
        <!-- Main content section, specific to each page -->
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
