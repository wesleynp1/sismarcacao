<x-main-template extraStyle="/css/list_scheduling.css">
    <h2>HORÁRIOS COM CLIENTES MARCADOS</h2>
    <div class="table-responsive">
        <table class="text-center table table-striped table-dark table-responsive ">
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
    </div>

    <h2>HORÁRIOS DISPONÍVEIS</h2>
    <p>desmarque e depois salve para indisponibilizar os horários</p>
    <form action="/agenda" method="post">
        @csrf            
        <div class="table-responsive">
            <table class="text-center table table-striped table-dark">
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
        </div>

        <input type="submit" value="SALVAR">
    </form>

    <a href="agenda/disponibilizar">DISPONIBILIZAR NOVOS HORÁRIOS</a>
</x-main-template>