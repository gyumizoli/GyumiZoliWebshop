<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üdvözöljük</title>
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
        </div>
        <div class="footer">
            <p>&copy; 2025 GyumiZoli Webshop. Minden jog fenntartva.</p>
        </div>
    </div>
</body>
</html>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            color: #777777;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>