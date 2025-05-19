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

        

        <h2>HORÁRIOS COM CLIENTES MARCADOS</h2>
        <table>
            <thead>
                <th>Datas</th>
                <th>Horários</th>
            </thead>

            <tbody>
                @foreach ($scheduledDatetimes as $key=>$scheduledDatetime)
                    <tr>
                        <td>{{ $scheduledDatetime->format("d/m/Y") }}</td>
                        <td>{{ $scheduledDatetime->format("H:i") }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>HORÁRIOS DISPONÍVEIS</h2>
        <p>desmarque e depois salve para indisponibilizar os horários</p>
        <form action="/agenda" method="post">
            @csrf            
            <table>
                <thead>
                    <th>Datas</th>
                    <th>Horários</th>
                    <th>Indisponibilizar</th>
                </thead>
                <tbody>
                    @foreach ($availableDatetimes as $key=>$availableDatetime)
                        <tr>
                            <td>{{ $availableDatetime->format("d/m/Y") }}</td>
                            <td>{{ $availableDatetime->format("H:i") }}</td>
                            <td>
                                <input type="checkbox" name="{{ 'datesToUnavailable[' . $key . ']' }}" value="{{ $availableDatetime->format('Y-m-d H:i:s') }}" id="{{ 'date'. $key }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <input type="submit" value="SALVAR">
        </form>

        <a href="agenda/disponibilizar">DISPONIBILIZAR NOVOS HORÁRIOS</a>

        <x-message/>
    </body>
</html>