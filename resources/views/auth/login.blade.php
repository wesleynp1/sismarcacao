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
        <form class="formulario" id="formLogin" action="/login" method="POST">
            @CSRF

            <img src="/img/usuario.png" alt="">
            
            <label for="inputEmail">E-mail</label>
            <input type="text" name="email" id="inputEmail" placeholder="insira seu email aqui..." required>

            <label for="inputPassword">Senha</label>
            <input type="password" name="password" id="inputPassword" placeholder="insira sua senha aqui..." required>

            <input type="submit" value="ENTRAR">           
        </form>

        <a href="/esqueciSenha">Esqueci minha senha</a>

        @if(Session::has("error"))
            <p class="falha">Erro:{{Session::get('error')}}</p>
            @php
                request()->session()->forget('error');
            @endphp
        @endif
        <x-message/>
    </body>
</html>