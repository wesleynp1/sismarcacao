<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/delete.css">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
        <title>SisMarcacao</title>
    </head>
    <body>
        <x-header/>
        
        <form action="/deletarServico/{{$service->id}}" method="post">
            @CSRF
            <p>Tem certeza que deseja deletar o seguinte serviço?</p>
            <p>"{{$service->name}}" ofertado por  R$ {{ str_replace(".",",",$service->price) }}</p>
            <a id="botaoNao" href="/servicos">NÃO</a>
            <input id="botaoSim" type="submit" value="SIM">

            <p>Lembrando que você pode editá-lo ao invés de exluir</p>
        </form>

        <x-message/>
    </body>
    
</html>