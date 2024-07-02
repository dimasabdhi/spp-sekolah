<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembayaran SPP</title>
    <style>
        /* Styling untuk PDF bisa disesuaikan */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Pembayaran SPP</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->order_id }}</td>
                    <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
