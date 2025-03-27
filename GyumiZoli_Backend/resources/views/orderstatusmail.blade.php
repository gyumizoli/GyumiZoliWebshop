<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendelés Állapota</title>
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
    <div class="email-container">
        <div class="header">
            <h1>Rendelés Állapot Frissítés</h1>
        </div>
        <div class="content">
            <p>Kedves {{ $content['name']}},</p>
            <p>A rendelésed állapota frissült. Az aktuális állapot:</p>
            <p><strong>{{ $content['status']}}</strong></p>
            <p>A szállítás várható dátuma: <strong>{{ $content['delivery_date'] }}</strong></p>
            <p>Ha bármilyen kérdésed van, kérjük, lépj kapcsolatba velünk.</p>
        </div>
        <div class="footer">
            <p>Köszönjük, hogy nálunk vásároltál!</p>
            <p>&copy; 2025 GyumiZoli Webshop</p>
        </div>
    </div>
</body>
</html>