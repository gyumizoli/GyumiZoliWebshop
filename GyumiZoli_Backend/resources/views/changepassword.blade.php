<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelszó megváltoztatva</title>
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
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Üdvözöljük, {{ $content['user'] }}!</h1>
        </div>
        <div class="content">
            <p>Kedves {{ $content['user'] }},</p>
            <p>Sikeresen megváltoztatta a jelszavát. Mostantól az új jelszavával tud bejelentkezni a weboldalunkra.</p>
            <p>Ha bármilyen kérdése van, ne habozzon kapcsolatba lépni velünk.</p>
            <p>Üdvözlettel,<br>A GyümiZöli Csapata</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 GyümiZöli Webshop. Minden jog fenntartva.</p>
        </div>
    </div>
</body>

</html>

