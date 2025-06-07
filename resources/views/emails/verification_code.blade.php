<!DOCTYPE html>
<html>
<head>
    <title>Kode Verifikasi Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background-color: #e9e9e9;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 15px;
            letter-spacing: 3px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Verifikasi Email Anda</h2>
        </div>
        <div class="content">
            <p>Terima kasih telah mendaftar! Untuk menyelesaikan pendaftaran Anda, silakan gunakan kode verifikasi di bawah ini:</p>
            <div class="code">{{ $code }}</div>
            <p>Kode ini berlaku selama 15 menit. Jika Anda tidak meminta kode ini, Anda bisa mengabaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Finder.</p>
        </div>
    </div>
</body>
</html>
