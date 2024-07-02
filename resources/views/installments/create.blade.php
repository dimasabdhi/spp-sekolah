<!DOCTYPE html>
<html>

<head>
    <title>Tambah Angsuran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Angsuran untuk Pembayaran #{{ $payment->order_id }}</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('installments.store', $payment->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah:</label>
                <input type="number" id="amount" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Angsuran</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
