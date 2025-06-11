<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>API MovieMania</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Fonte + estilo básico --}}
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .container {
            max-width: 600px;
            text-align: center;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: inset 0 0 0 1px rgba(26, 26, 0, 0.16);
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        p {
            color: #706f6c;
            margin-bottom: 1.5rem;
        }
        a {
            text-decoration: none;
            color: white;
            background-color: #1b1b18;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo à API do MovieMania</h1>
        <p>Este é o backend da aplicação MovieMania. Para mais detalhes, consulte a documentação.</p>
        <a href="{{ url('/docs') }}">Ver documentação da API</a>
    </div>
</body>
</html>
