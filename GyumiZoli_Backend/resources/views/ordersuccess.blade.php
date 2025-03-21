<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendelés Összesítő</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: left; /* Balra igazítva */
        }

        h1 {
            color: #4CAF50;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: 600;
        }

        p {
            font-size: 18px;
            color: #555;
            margin: 15px 0;
            line-height: 1.6;
        }

        .order-details {
            margin-top: 30px;
        }

        .order-details h2 {
            color: #333;
            font-size: 1.8em;
            font-weight: 600;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .order-details ul {
            list-style-type: none;
            padding: 0;
        }

        .order-details li {
            background-color: #fafafa;
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .order-details li:hover {
            background-color: #e0f7fa;
            border-color: #4CAF50;
        }

        .order-details li:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .order-details li strong {
            display: block;
            font-size: 16px;
            color: #4CAF50;
        }

        .highlight {
            color: #4CAF50;
            font-weight: 600;
        }

        .highlight-bg {
            background-color: #e0f7fa;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            color: #4CAF50;
            margin-top: 10px;
        }

        .footer {
            margin-top: 30px;
            font-size: 16px;
            color: #777;
        }

        .footer p {
            margin: 10px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            margin: 20px 0;
            font-size: 18px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }

        .icon {
            margin-right: 10px;
            color: #4CAF50;
        }

        @media only screen and (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }
            h1 {
                font-size: 2em;
            }
            p, .order-details li {
                font-size: 16px;
            }
            .order-details h2 {
                font-size: 1.6em;
            }
        }

        @media only screen and (max-width: 480px) {
            .container {
                width: 95%;
                padding: 20px;
            }
            h1 {
                font-size: 1.8em;
            }
            p, .order-details li {
                font-size: 14px;
            }
            .order-details h2 {
                font-size: 1.4em;
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
