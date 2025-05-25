<form class="form container mt-2" id="formScheduling" action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="inputNome" class="form-label m-0">Nome</label>
        <input type="text" name="client_name" id="inputClient" value="{{ isset($scheduling) ? $scheduling->client_name : '' }}" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="serviceId" class="form-label m-0">Servico</label>
        <select name="serviceId" id="serviceId" class="form-select">

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
    </div>

    <div class="mb-3">
        <label for="select_date" class="form-label m-0">Data</label>
        <select name="scheduled_time" id="select_date" class="form-select">
            @if(isset($scheduling->scheduled_time))
                <option value="{{ $scheduling->scheduled_time }}">{{ $scheduling->scheduled_time }}</option>
            @endif

            @foreach($datetimes as $datetime)
                @if(empty($scheduling) || $datetime != $scheduling->scheduled_time)
                    <option value="{{ $datetime }}">{{ $datetime }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <input type="submit" id="botaoSubmit" value="CADASTRAR" class="btn btn-primary mt-2">
</form> 