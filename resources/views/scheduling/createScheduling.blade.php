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

        <x-form-scheduling :services="$services" action="novaMarcacao"/>
        
        <x-message/>
    </body>
</html>