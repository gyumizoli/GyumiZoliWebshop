<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Rendelés Összesítő</title>
   
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
        .order-details {
            margin-top: 20px;
        }
        .order-details h2 {
            color: #555555;
            border-bottom: 2px solid #f4f4f4;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 1.8em;
        }
        .order-details ul {
            list-style-type: none;
            padding: 0;
        }
        .order-details li {
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
            transition: background-color 0.3s;
        }
        .order-details li:hover {
            background-color: #e0f7fa;
        }
        .order-details li:nth-child(odd) {
            background-color: #e9e9e9;
        }
        .order-details li strong {
            display: block;
            margin-bottom: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
        .highlight {
            color: #59b84c;
        }
        .highlight-bg {
            background-color: #85db89;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            border: 2px solid #59b84c;
        }
        .order-time {
            font-size: 14px;
            color: #888888;
            text-align: center;
            margin-top: 10px;
        }
        .icon {
            margin-right: 10px;
            color: #59b84c;
        }
        @media only screen and (max-width: 600px) {
            .container {
                width: 95%;
                padding: 20px;
            }
            h1 {
                font-size: 2em;
            }
            p, .order-details li {
                font-size: 14px;
            }
            .order-details h2 {
                font-size: 1.5em;
            }
            .footer {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="highlight">{{ $content['title'] }}</h1>
        <p><strong>Név:</strong> {{ $content['customers_name'] }}</p>
        <p><strong>Telefon:</strong> {{ $content['customers_phone'] }}</p>
        <p><strong>Szállítási cím:</strong> {{ $content['delivery_address'] }}</p>
        <p><strong>Fizetési mód:</strong> {{ $content['payment_method'] }}</p>
        <p><strong>Teljes rendelési összeg:</strong> <span class="highlight-bg">{{ $content['totalPrice'] }} Ft</span></p>
        
        <div class="order-details">
            <h2>Rendelési tételek:</h2>
            <ul>
                @foreach($content['items'] as $item)
                    <li>
                        <div>
                            <p><strong>Termék:</strong> {{$item["name"]}}</p>
                            <p><strong>Mennyiség:</strong> {{$item["quantity"]}} {{$item["unit"]}}</p>
                            <p><strong>Ár:</strong> {{$item["totalPrice"]}} Ft</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <div class="footer">
            <p>Köszönjük, hogy minket választott!</p>
        </div>
    </div>
</body>
</html>