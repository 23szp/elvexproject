<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jelszó visszaállítása</title>
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
            color: #9333ea;
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
            background-color: #9333ea;
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
            background-color: #7a29c2;
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
            color: #9333ea;
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
            <h2 style="color: #9333ea;">Jelszó visszaállítása</h2>
            <p>Kedves {{ $user->name }}!</p>
            <p>Ezt az emailt azért kaptad, mert jelszó-visszaállítási kérelmet kaptunk a fiókodhoz.</p>
            <a href="{{ $resetUrl }}" class="button">Jelszó visszaállítása</a>
            <p>Ez a jelszó-visszaállító link 60 percig érvényes.</p>
            <p>Ha nem te kérted a jelszó visszaállítását, nincs további teendőd.</p>
        </div>
        <div class="footer">
            <p>Üdvözlettel,<br>Az ElveX csapata</p>
        </div>
    </div>
</body>
</html>
