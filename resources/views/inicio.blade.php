<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/style.css">
        <title>SisMarcacao</title>
    </head>
    <body>
        <x-header/>        
        @auth
        <a href="/novoServico">
            <p>novo Servico(provisório)</p>
        </a>        
        <a href="/mudarSenha">
            <p>mudar Senha(provisório)</p>
        </a>        
        @endauth

        <a href="/novaMarcacao">
            <p>Nova Marcação(provisório)</p>
        </a>
    </body>    

    <x-message/>
</html>