<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Host Event</title>
  <!--CSS-->
  <link rel="stylesheet" href="css/style.css">
  <!--defer faz com que o js seja executado dps q o html for executado-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"
        defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!--CSS -->
</head>
    <body>
        <!--NAVBAR-->
        <nav class="navbar-dark bg-dark navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">HostEvent</a>
            <!--SÓ APARECE NO CELULAR-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form action="/" method="get" class="form-inline my-2 my-lg-0">
              <input name="search" class="form-control mr-sm-2" type="text" aria-label="Search">
            </form>  
            <!--LINKS-->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="float: right;">
                @auth
                            {{--auth serve pra mostrar coisas pra quem tá logado--}}
                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard">Meus eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/create">Criar eventos</a>
                            </li>
                            <li class="nav-item">
                                <form action="/logout" method="post">
                                @csrf
                                    <a class="nav-link" href="/" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                                    {{--closest('form') fecha o formulario mais perto--}}
                                </form>
                            </li>
                        @endauth
                        @guest
                        {{--guest serve pra mostrar coisas pra pessoas não logadas--}}
                        <li class="nav-item">
                                <a class="nav-link" href="/login">logar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">cadastrar</a>
                            </li>
                        @endguest
            </ul>       
         </div>
        </nav>
        @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    @if ($busca)
        <h6>Procurando por {{$busca}}</h6>
    @endif
    @if(empty($busca)  && count($events)>0)
        <h6>Proximos eventos</h6>
    @endif
    @if (count($events) == 0 && $busca)
        <h6>Evento não encontrado</h6>
    @elseif (count($events) == 0)
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="col-md-12 centered my-auto" style="width: max-content;margin-right:12rem;margin-left:12rem">
        <a type="submit" href="/create" class="btn btn-primary btn-lg">Nenhum evento disponivel.</br>Click aqui para criar um!</a>
    </div>
    @else
    <div style="margin-right:12rem;margin-left:12rem;display: flex;flex-wrap: wrap;align-items: center;">
    @foreach ($events as $event)
    <a href="/event/{{$event->id}}">
    <div class="container marketing" style="height: 190px;width: 300px;">   
            <div class="row featurette">
              <div style="color: #000;">
                @if(isset($event->imagem))
                <div class="img-box">
                    <img class="img-event-post" src="/img/events/{{$event->imagem}}" alt="{{$event->title}}"></img>
                </div>
                @endif
                <div class="p-2 d-flex flex-column  align-items-center border border-secondary rounded" style="position: relative !important;background: white;@php if(isset($event->imagem)) echo 'margin-top: -10px;' @endphp">
                    <p class="estiloFont"><b>{{$event->cidade}} ° {{date('d/m/y', strtotime($event->date))}} > {{date('h:m', strtotime($event->time))}}</b></p>
                    <p class="estiloFont" class="truncate-1l" style="display: flex;justify-content: space-around;" ><b>{{$event->nomeEvento}}</b></p>
                </div>
            </div>
        </div>
    </div>
</a>
@endforeach
</div>
    @endif
    @if ($busca)
    <a style="" href="/">Ver todos os eventos</a>
    @endif
  <!--SCRIPTS-->
  <script src="js/jquery.js"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="js/script.js"></script>
  <script 
  src = "https://code.jquery.com/jquery-3.4.1.min.js" integridade = "sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin = "anonymous" > </script>
  

</body>

</html>