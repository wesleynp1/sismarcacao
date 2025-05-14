<form class="form" id="formScheduling" action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf

    <label for="inputNome" >Nome</label>
    <input type="text" name="client_name" id="inputClient" value="{{ isset($scheduling) ? $scheduling->client_name : '' }}" required>
    <br>

    <label for="serviceId">Servico</label>
    <select name="serviceId" id="serviceId">

        @if(isset($scheduling))
            @foreach ($services as $service)
                @if($service->id==$scheduling->serviceId)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endif
            @endforeach

            @foreach ($services as $service)
                @if($service->id!=$scheduling->serviceId)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endif
            @endforeach

        @else
            @foreach ($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        @endif
    </select>
    <br>

    <label for="select_date">Data</label>
    <select name="scheduled_time" id="select_date">
        @if(isset($scheduling->scheduled_time))
            <option value="{{ $scheduling->scheduled_time }}">{{ $scheduling->scheduled_time }}</option>
        @endif

        @foreach($datetimes as $datetime)
            @if(empty($scheduling) || $datetime != $scheduling->scheduled_time)
                <option value="{{ $datetime }}">{{ $datetime }}</option>
            @endif
        @endforeach
    </select>
    <br>

    <input type="submit" id="botaoSubmit" value="CADASTRAR">
</form> 