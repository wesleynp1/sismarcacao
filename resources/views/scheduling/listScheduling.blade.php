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

        @foreach ($schedules as $schedule)
            <p>Cliente:{{ $schedule->client_name }}</p>
            <p>Marcação para: {{ date_format($schedule->scheduled_time," Y/m/d H:i") }}</p>
            <p>Serviço:{{ $schedule->service_name }}</p>

            <a href="editarAgendamento/{{ $schedule->id }}">editar</a>
            <a href="deletarAgendamento/{{ $schedule->id }}">excluir</a>

        @endforeach
        
        <x-message/>
    </body>
</html>
