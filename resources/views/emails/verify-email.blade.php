<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email cím megerősítése</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .email-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 30px;
            box-sizing: border-box;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo h1 {
            font-size: 28px;
            color: #6639a6;
            margin: 0;
        }
        .content {
            text-align: center;
            color: #333333;
        }
        .content p {
            margin: 10px 0;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            background-color: #6639a6;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #5a2e91;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666666;
            text-align: center;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
        }
        .link {
            color: #6639a6;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <h1>ElveX</h1>
        </div>
        <div class="content">
            <p>Kedves {{ $user->name }}!</p>
            <p>Köszönjük, hogy regisztráltál az ElveX oldalán. Kérjük, erősítsd meg az email címedet az alábbi gombra kattintva:</p>
            <a href="{{ $verificationUrl }}" class="button">Email cím megerősítése</a>
            <p>Ha nem te regisztráltál, kérjük, hagyd figyelmen kívül ezt az emailt.</p>
            <p>Ha a gomb nem működik, másold be az alábbi linket a böngésződbe:</p>
            <p class="link">{{ $verificationUrl }}</p>
        </div>
        <div class="footer">
            <p>Üdvözlettel,<br>Az ElveX csapata</p>
        </div>
    </div>
</body>
</html>
