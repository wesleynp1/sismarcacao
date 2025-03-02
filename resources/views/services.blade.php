<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>SisMarcacao</title>
    </head>
    <body>
        <x-header/>
        <div id="container-services">
            @foreach ($services as $service)
                <div class="service">
                    <p>{{$service->name}}</p>
                    <p>R$ {{ str_replace(".",",",$service->price) }}</p>
                    <img src="{{ asset($service->image) }}" alt="">
                    <p>{!! $service->description !!}</p>
                </div>
            @endforeach
        </div>

        <style>
            #container-services{
                display: flex;
                justify-content: space-around;

                .service{
                    background-color: rgba(100,100,100,0.6);
                    margin: 4px;
                }
            }
        </style>

        <x-message/>
    </body>
</html>