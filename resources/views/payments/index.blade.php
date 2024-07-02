<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Pembayaran</h2>
        <form action="{{ route('payment.create') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah:</label>
                <input type="number" id="amount" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Bayar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
