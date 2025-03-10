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
        <form class="formulario" id="formLogin" action="/forgot-password" method="POST">
            @CSRF
            
            <label for="inputEmail">E-mail</label>
            <input type="text" name="email" id="inputEmail" placeholder="insira seu email aqui..." required>

            <input type="submit" value="ENVIAR E-MAIL">
        </form>
        <p>Te enviaremos um link por email, basta clicar nele</p> 
        <p>DICA: se não encontrá-lo na sua caixa de email verifique a caixa de SPAM</p>

        <x-message/>
    </body>
</html>