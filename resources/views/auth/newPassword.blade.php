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
        <form class="formulario" id="formLogin" action="/reset-password" method="POST">
            @CSRF
            
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <label for="inputPassword">Nova Senha</label>
            <input type="password" name="password" id="inputPassword" placeholder="insira seu email aqui..." required>

            <label for="inputPassword">Repita Nova Senha</label>
            <input type="password" name="password_confirmation" id="inputPassword" placeholder="insira seu email aqui..." required>

            <input type="submit" value="Redefinir Senha">
        </form>

        <x-message/>
    </body>
</html>