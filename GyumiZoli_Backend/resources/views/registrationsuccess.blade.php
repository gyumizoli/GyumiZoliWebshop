<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üdvözöljük</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            margin: 20px 0;
            font-size: 16px;
            color: #333333;
        }
        .footer {
            text-align: center;
            color: #777777;
            font-size: 12px;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Üdvözöljük, {{ $content['user'] }}!</h1>
        </div>
        <div class="content">
            <p>Kedves {{ $content['user'] }},</p>
            <p>Köszönjük, hogy regisztrált a weboldalunkon. Mostantól hozzáférhet a legújabb termékeinkhez és ajánlatainkhoz.</p>
            <p>Ha bármilyen kérdése van, ne habozzon kapcsolatba lépni velünk.</p>
            <p>Üdvözlettel,<br>A GyumiZoli Csapata</p>
            <a href="{{ url('/') }}" class="button">Vissza a főoldalra</a>
        </div>
        <div class="footer">
            <p>&copy; 2025 GyumiZoli Webshop. Minden jog fenntartva.</p>
        </div>
    </div>
</body>
</html>