<header>
    <h1>Sistema de Marcação de atendimento</h1>

    <nav>
        <a href="/">Início</a>
        <a href="/servicos">Serviços Oferecidos</a>
        <a href="#agenda">Agendamento</a>
    </nav>
</header>

<style>
    header{ 
        flex: content;
        background:rgba(16,16,16,0.5);
        padding: 8px;
        border-radius: 16px;
        justify-content: center;
        
        h1{
            margin: 4px;
        }

        nav{
            display: flex;
            justify-content: space-around;

            a{
                flex: 1;
                text-decoration: none;
                background:rgba(100,100,100,0.5);
                color: white;
                border-radius: 8px;
                margin: 0px 2px;
            }

            a:hover{
                background:rgba(200,200,200,0.5);
                color: black;                
            }
        }  
    }
</style>