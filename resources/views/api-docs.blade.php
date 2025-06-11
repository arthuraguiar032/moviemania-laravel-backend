<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Documentação da API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            margin: 0;
            padding: 2rem;
        }
        h1, h2 {
            margin-top: 1.5rem;
        }
        code {
            background: #eee;
            padding: 2px 4px;
            border-radius: 4px;
        }
        .route {
            margin-bottom: 1rem;
        }
        .route span {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <h1>Documentação da API - MovieMania</h1>
    <p>Esta é a documentação das rotas disponíveis nesta API.</p>

    <h2>Rotas Públicas</h2>

    <div class="route">
        <span>GET</span> <code>/api/v1/sed/unidade/unidades</code><br>
        <small>Lista todas as unidades cadastradas.</small>
    </div>

    <div class="route">
        <span>GET</span> <code>/api/v1/auxiliar/projeto/{id}</code><br>
        <small>Retorna os detalhes formatados de um projeto pelo ID.</small>
    </div>

    <div class="route">
        <span>POST</span> <code>/api/v1/sed/unidade</code><br>
        <small>Cria uma nova unidade.</small>
    </div>

    <h2>Autenticação</h2>

    <div class="route">
        <span>POST</span> <code>/api/login</code><br>
        <small>Realiza login com credenciais válidas. Retorna token JWT.</small>
    </div>

    <div class="route">
        <span>GET</span> <code>/api/user</code><br>
        <small>Retorna dados do usuário autenticado.</small>
    </div>

    <p style="margin-top: 2rem;"><a href="{{ url('/') }}">← Voltar para a página inicial</a></p>
</body>
</html>
