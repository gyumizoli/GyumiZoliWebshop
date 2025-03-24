<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendelés Összesítő</title>
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
            border-top: 5px solid #4CAF50;
        }
        h1 {
            color: #4CAF50;
            font-size: 24px;
            margin: 0 0 30px 0;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #4CAF50;
        }
        p {
            color: #333333;
            margin: 15px 0;
            font-size: 16px;
        }

        .order-details {
            margin-top: 30px;
        }

        .order-details h2 {
            color: #4CAF50;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .order-details ul {
            list-style-type: none;
            padding: 0;
        }

        .order-details li {
            background-color: #f9f9f9;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
        }

        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }

        .highlight-bg {
            background-color: #e8f5e9;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eeeeee;
            text-align: center;
            color: #666666;
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
        <h1 class="highlight">{{ $content['title'] }}</h1>
        <p><strong>Név:</strong> {{ $content['customers_name'] }}</p>
        <p><strong>Telefon:</strong> {{ $content['customers_phone'] }}</p>
        <p><strong>Szállítási cím:</strong> {{ $content['delivery_address'] }}</p>
        <p><strong>Fizetési mód:</strong> {{ $content['payment_method'] }}</p>
        <p><strong>Teljes rendelési összeg:</strong> <span class="highlight-bg">{{ $content['totalPrice'] }} Ft</span></p>
        
        <div class="order-details">
            <h2> Rendelési tételek:</h2>
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
