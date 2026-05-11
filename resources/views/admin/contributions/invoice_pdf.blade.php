<!DOCTYPE html>
<html>

<head>
    <title>Kwitansi Iuran STT DSM</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .content {
            margin-top: 20px;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>STT DHARMA SATYA MANDALA</h2>
        <p>Kwitansi Pembayaran Iuran Anggota</p>
    </div>
    <div class="content">
        <p>Telah diterima dari: <strong>{{ $contribution->member->name }}</strong></p>
        <p>Untuk Periode: <strong>{{ $contribution->month }} {{ $contribution->year }}</strong></p>
        <p>Jumlah: <strong>Rp {{ number_format($contribution->amount, 0, ',', '.') }}</strong></p>
        <p>Status: <strong>LUNAS</strong></p>
    </div>
    <div class="footer">
        <p>Bali, {{ date('d F Y') }}</p>
        <br><br>
        <p>( Bendahara STT )</p>
    </div>
</body>

</html>
