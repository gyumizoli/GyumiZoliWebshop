<!DOCTYPE html>
<html>
<head>
    <title>Email cím megváltoztatásának visszaigazolása</title>
    <style>
        body {
            font-family: 'Roboto', 'Open Sans', Arial, sans-serif;
            background: linear-gradient(165deg, #9CCC65 0%, #2E7D32 100%);
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 100%;
            max-width: 700px;
            background-color: #ffffff;
            padding: 50px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            text-align: left;
            line-height: 1.8;
            position: relative;
            border-top: 6px solid #2E7D32;
            
        }
        h1 {
            color: #1B5E20;
            font-size: 30px;
            margin-bottom: 35px;
            text-align: center;
            border-bottom: 4px solid #4CAF50;
            padding-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
        }
        p {
            color: #424242;
            margin: 18px 0;
            font-size: 17px;
            letter-spacing: 0.4px;
            line-height: 1.9;
        }
        p:last-child {
            margin-top: 40px;
            color: #1B5E20;
            font-weight: 600;
            font-style: italic;
            border-top: 2px solid #e0e0e0;
            padding-top: 25px;
            text-align: right;
        }
        @media (max-width: 600px) {
            .container {
                padding: 30px;
                margin: 15px;
            }
            h1 {
                font-size: 26px;
                margin-bottom: 25px;
            }
            p {
                font-size: 16px;
            }
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h1>Email cím megváltoztatásának visszaigazolása</h1>
        <p>Kedves {{ $content['user']}}!</p>
        <p>Értesítjük, hogy az email címe sikeresen megváltozott.</p>
        <p>Ha nem Ön kezdeményezte ezt a változtatást, kérjük, azonnal lépjen kapcsolatba ügyfélszolgálatunkkal.</p>
        <p>Köszönjük, hogy szolgáltatásunkat használja!</p>
        <p>Üdvözlettel,</p>
        <p>A GyumiZoli csapata</p>
    </div>
</body>
</html>

