<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemasukan Bulanan - {{ $monthName }} {{ $year }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #0891b2;
            padding-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #0891b2;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #666;
        }

        .total-box {
            background: #f0f9ff;
            border: 2px solid #0891b2;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
            border-radius: 8px;
        }

        .total-box h2 {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        .total-box .amount {
            font-size: 32px;
            font-weight: bold;
            color: #059669;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #0891b2;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        tr:nth-child(even) {
            background: #f9fafb;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }

        @media print {
            body {
                padding: 20px;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN PEMASUKAN BULANAN</h1>
        <p>Periode: {{ $monthName }} {{ $year }}</p>
    </div>

    <div class="total-box">
        <h2>Total Pemasukan</h2>
        <div class="amount">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA PENYEWA</th>
                <th>KAMAR/VILLA</th>
                <th>TOTAL HARGA</th>
                <th>TANGGAL BOOKING</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $index => $booking)
                @php $unit = $booking->kamar ?? $booking->villa; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->penyewa->namapenyewa ?? '-' }}</td>
                    <td>{{ $unit->namakamar ?? $unit->namavilla ?? '-' }}</td>
                    <td>Rp {{ number_format($booking->totalharga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->tglmulai)->format('d F Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        Tidak ada data booking untuk periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y H:i') }}</p>
    </div>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</body>

</html>