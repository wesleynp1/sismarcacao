<x-main-template extraStyle="/css/list_service.css">

    @auth
    <a href="/novoServico">
        <p id="newServiceButton">+ Cadastrar Novo Servico</p>
    </a> 
    @endauth

    <div id="container-services">
        @foreach ($services as $service)
            <div class="service">
                <a href="">
                    <p> {{$service->id}} - {{$service->name}}</p>
                    <p>R$ {{ str_replace(".",",",$service->price) }}</p>
                    <img src="{{ asset($service->image) }}" alt="">
                    <p>{!! $service->description !!}</p>
                </a>
                
                @auth
                    <a href="/deletarServico/{{ $service->id }}">deletar</a>
                    <a href="/editarServico/{{ $service->id }}">editar</a>
                @endauth
                
            </div>
        @endforeach
    </div>

</x-main-template>