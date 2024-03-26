<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo de los Cabesas Riders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5e6e6;
            margin: 0;
            padding: 0;
        }

        .container {
            justify-content: center;
            align-items: center;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #2A73FC;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-top: 0;
            text-align: center;
        }

        h2,h3,h4{
            color:#C0C4CA;
            text-align: center;
        }

        h4{
            text-align: justify;
        }
        .imagen {
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .imagen img{
            width: 200px;
            text-align: center;
            margin-bottom: 5px;
            margin: auto;
            color: #6A6C70;
        }
        p {
            color: #4d4e50;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="imagen">
            <img src="https://www.blog.sangut.site/riders/LOGO_RAIDERS.PNG" alt="Logo de los Cabesas Riders">
        </div>
        <h1>Correo de los Cabesas Riders</h1>
        <h2>{{ $mailData['title'] }}</h2>
        <h3>{{ $mailData['from'] }}</h3>
        <h4>"{{ $mailData['body'] }}"</h4>
        <p>Ánimo y sigue su ejemplo, hazte partícipe de la historia de este grupo singular.</p>
    </div>
</body>

</html>
