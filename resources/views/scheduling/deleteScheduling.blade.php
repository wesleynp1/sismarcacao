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

        <form action="/deletarAgendamento/{{$scheduling->id}}" method="post">
            @CSRF
            <p>Tem certeza que deseja deletar o seguinte agendamento?</p>
            <p>Cliente {{ $scheduling->client_name }} marcada em {{ $scheduling->scheduled_time }} para o serviço {{ $scheduling->service_name }}</p>
            <a id="botaoNao" href="/agendamentos">NÃO</a>
            <input id="botaoSim" type="submit" value="SIM">

            <p>Lembrando que você pode editá-lo ao invés de excluir</p>
        </form>
        
        <x-message/>
    </body>
</html>