<!DOCTYPE html>
<html>
<head>
    <title>Email cím megváltoztatásának visszaigazolása</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

