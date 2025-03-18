<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció Sikeres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5em;
        }
        p {
            font-size: 16px;
            color: #555555;
            margin: 10px 0;
        }
        .highlight {
            color: #59b84c;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="highlight">{{$content["title"]}}</h1>
        <p><h3>{{$content["user"]}}</h3>Gratulálok sikeresen regisztrált a GyümiZöli Webshopra</p>
        <p><h3>Kellemes időtöltést kívánunk!</h3></p>
        <div class="footer">
            <p>Köszönjük, hogy minket választott!</p>
        </div>
    </div>
</body>
</html>