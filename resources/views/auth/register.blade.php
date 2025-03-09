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
        <form class="formulario" id="formLogin" action="/registrar" method="POST">
            @CSRF

            <label for="inputName">Nome</label>
            <input type="text" name="name" id="inputName" placeholder="insira seu nome aqui..." required>
            
            <label for="inputEmail">E-mail</label>
            <input type="text" name="email" id="inputEmail" placeholder="insira seu email aqui..." required>

            <label for="inputPassword">Senha</label>
            <input type="password" name="password" id="inputPassword" placeholder="insira sua senha aqui..." required>

            <input type="submit" value="ENTRAR">           
        </form>
    </body>
</html>