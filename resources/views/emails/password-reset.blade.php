<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - DEDY KOST</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #06b6d4 0%, #2563eb 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        .content {
            padding: 40px 30px;
        }

        .content p {
            margin: 0 0 20px 0;
            font-size: 16px;
            color: #555;
        }

        .button {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #06b6d4 0%, #2563eb 100%);
            color: white !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }

        .button:hover {
            opacity: 0.9;
        }

        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #e0e0e0;
        }

        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .warning p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Reset Password</h1>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $user->namapenyewa }}</strong>,</p>

            <p>Kami menerima permintaan untuk mereset password akun Anda di DEDY KOST.</p>

            <p>Klik tombol di bawah ini untuk mereset password Anda:</p>

            <div style="text-align: center;">
                <a href="{{ $resetLink }}" class="button">Reset Password</a>
            </div>

            <p style="font-size: 14px; color: #666; margin-top: 30px;">
                Atau copy dan paste link berikut ke browser Anda:<br>
                <a href="{{ $resetLink }}" style="color: #06b6d4; word-break: break-all;">{{ $resetLink }}</a>
            </p>

            <div class="warning">
                <p><strong>⚠️ Penting:</strong></p>
                <p>• Link ini akan kadaluarsa dalam 60 menit</p>
                <p>• Jika Anda tidak meminta reset password, abaikan email ini</p>
                <p>• Jangan bagikan link ini kepada siapapun</p>
            </div>

            <p style="margin-top: 30px;">
                Terima kasih,<br>
                <strong>Tim DEDY KOST</strong>
            </p>
        </div>

        <div class="footer">
            <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
            <p>© {{ date('Y') }} DEDY KOST. All rights reserved.</p>
        </div>
    </div>
</body>

</html>