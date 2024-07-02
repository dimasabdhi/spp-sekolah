<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('/images/dashboard-background.jpg');
            /* Ganti dengan nama file gambar Anda */
            background-size: cover;
            background-position: center;
        }

        .dashboard-content {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="dashboard-content">
            <h2>Dashboard</h2>
            <p>Welcome, {{ Auth::user()->name }}</p>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn btn-danger">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
