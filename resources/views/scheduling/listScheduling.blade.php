<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/style.css">    
        <link rel="stylesheet" href="/css/list_scheduling.css"> 
        <title>SisMarcacao</title>
    </head>
    <body>
        <x-header/>

        
        <table>
            <thead>
                <th>Nome da cliente</th>
                <th>Data e Hora marcada</th>
                <th>Serviço</th>
            </thead>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->client_name }}</td>
                    <td>{{ date_format($schedule->scheduled_time," d/m/Y H:i") }}</td>
                    <td>{{ $schedule->service_name }}</td>

                    <td><a href="editarAgendamento/{{ $schedule->id }}">editar</a></td>
                    <td><a href="deletarAgendamento/{{ $schedule->id }}">excluir</a></td>
                </tr>
            @endforeach
        </table>
        
        <x-message/>
    </body>
</html>
