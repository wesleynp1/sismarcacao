<x-main-template extraStyle="/css/list_service.css">

    @auth
    <a href="/novoServico">        
            <p id="newServiceButton">+ Cadastrar Novo Servico</p>        
    </a> 
    @endauth

    <div id="container-fluid container-services">
        <div class="row container-fluid m-auto mt-4 justify-content-evenly">
            @foreach ($services as $service)
                <div class="service border m-1 col-12 col-sm-5 col-md-5 col-lg-3 col-xxl-2 p-0 text-wrap text-break">
                    <a href="" class="text-wrap">
                        <h2>{{$service->name}}</h2>
                        <img src="{{ asset($service->image) }}" alt="" class="rounded px-4 img-fluid"/>
                        <h2>R$ {{ str_replace(".",",",$service->price) }}</h2>
                        <p>{!! $service->description !!}</p>
                    </a>
                    
                    @auth
                        <a href="/deletarServico/{{ $service->id }}">deletar</a>
                        <a href="/editarServico/{{ $service->id }}">editar</a>
                    @endauth
                    
                </div>
            @endforeach
        </div>
    </div>

</x-main-template>