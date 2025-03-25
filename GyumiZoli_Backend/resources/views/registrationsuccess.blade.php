<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üdvözöljük</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, Helvetica, sans-serif;
            -webkit-font-smoothing: antialiased;
            line-height: 1.6;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 40px;
            box-sizing: border-box;
            border-radius: 8px;
            border-top: 5px solid #2E7D32;
        }
        h1 {
            color: #2E7D32;
            font-size: 24px;
            margin: 0 0 30px 0;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #9CCC65;
        }
        p {
            color: #333333;
            margin: 15px 0;
            font-size: 16px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #2E7D32;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #1B5E20;
        }
        p:last-child {
            margin-top: 30px;
            color: #2E7D32;
            font-weight: bold;
            padding-top: 15px;
            border-top: 1px solid #eeeeee;
            text-align: right;
        }
        @media screen and (max-width: 600px) {
            .container {
                width: 100%;
                padding: 20px;
                margin: 10px;
            }
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
        </div>
        <div class="footer">
            <p>&copy; 2025 GyumiZoli Webshop. Minden jog fenntartva.</p>
        </div>
    </div>
</body>
</html>