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

        <h2>HORÁRIOS INDISPONÍVEIS NESTE MOMENTO</h2>
        
        <form action="/agenda/disponibilizar" method="post">
            @csrf
            <table>
                <thead>
                    <tr>
                        
                        <th>Dia</th>
                        <th>Horários</th>
                        <th>Disponibilizar</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td rowspan="24">
                            <input type="date" value="{{ date('Y-m-d')}}" name="" id="unavailableDateInput">
                        </td>
                        <td>00:00</td>
                        <td>
                                <input 
                                type="checkbox" 
                                name="newAvailableDatetime[0]"
                                value="{{ date('Y-m-d 00:00:00')}}" 
                                id="'date0'" 
                                class="unavailables">
                        </td>
                    </tr>

                    @for ($i = 1; $i < 24; $i++)
                        <tr> 
                            <td>
                                {{  $i < 10 ? '0'.$i  : $i }}:00
                            </td>

                            <td>
                                <input 
                                type="checkbox" 
                                name="{{ 'newAvailableDatetime['. $i .']'}}" 
                                value="{{ date('Y-m-d ') . ($i < 10 ? '0' : '') . $i . ':00:00'}}"
                                id="{{ 'date'. $key }}" 
                                class="unavailables">
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <input type="submit" value="SALVAR">
        </form>

        <script>
            let unavailableDateInput   = document.getElementById("unavailableDateInput");
            let unavailablesCheckboxes = document.getElementsByClassName("unavailables");

            unavailableDateInput.onchange = (e)=>{
                for(let unavailablesCheckbox of unavailablesCheckboxes)
                    unavailablesCheckbox.value = unavailableDateInput.value + unavailablesCheckbox.value.slice(10,19);                
            }
        </script>

        <x-message/>
    </body>
</html>