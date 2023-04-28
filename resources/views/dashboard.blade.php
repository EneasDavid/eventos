<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Host Event</title>
  <!--CSS Bootstrap-->
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!--CSS -->
</head>

<body>
        <!--NAVBAR-->
        <nav class="navbar-dark bg-dark navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand logo" href="/">HostEvent</a>
            <!--SÓ APARECE NO CELULAR-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--LINKS--> 
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="float: right;">
                @auth
                {{--auth serve pra mostrar coisas pra quem tá logado--}}
                  <li class="nav-item">
                    <a class="nav-link active" href="/dashboard" style="cursor:pointer">MEUS EVENTOS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/create">CRIAR EVENTOS</a>
                  </li>
                  <li class="nav-item">
                    <form class="bform" action="/logout" method="post">
                      @csrf
                      <a class="nav-link logout" href="/" style="cursor:pointer" onclick="event.preventDefault(); this.closest('form').submit();">SAIR</a>
                      {{--closest('form') fecha o formulario mais perto--}}
                    </form>
                  </li>
              @endauth
            </ul>       
         </div>
        </nav>
        </br>
        @if (session('msg'))
            <div class="alert alert-success">
            {{ session('msg') }}
            </div>
        @endif
        <div class="container">
            <div class="left">
            <div style="display: grid;justify-items: center;">
             @if(!empty($user->foto))
              <label tabIndex="0" for="picture__input" type="file" class="picture" style="padding:0px!important">
                 <img src="/img/usuarios/{{$user->foto}}" class="fotoPerfil" alt="Não foi possível carregar sua foto" style="height: 15rem;width: 15rem;">
              </label>
              @else
              <label tabIndex="0" for="picture__input" type="file" class="picture" style="background: rgb(219, 221, 223);border-radius:100%">
                 <img src="/img/user.png" class="fotoPerfil" style="height: 15rem;width: 15rem;"></img>
              </label>
              @endif
              <strong>{{$user->name}}</strong>
              <a class="btn btn-primary mb-3" href="/editarUsuario/{{$user->id}}">Editar</a>
              </div>
              </div>
        <div class="right">
        <h1 class="">Meus eventos</h1>
            <div class="dashbord-events-container">
            @if(count($events)>0) 
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <th scope="row">{{$event->id}}</th>
                                <th scope="row"><a href="/event/{{$event->id}}">{{$event->nomeEvento}}</a></th>
                                <th scope="row">{{count($event->users)}}</th>
                                @if(!$event->finalizada)
                                <th scope="row" >
                                    <a href="/event/edit/{{$event->id}}">Editar</a> |
                                    <a class="btn btn-infoedit-btn" href="/event/{{$event->id}}">
                                        <form class="bform" action="/event/{{$event->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                                        </form>
                                    </a> |
                                <a href="/event/end/{{$event->id}}"> Finalizar</a> 
                            </th>
                            @else
                                <th>Evento Finalizado</th>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Você ainda não criou nenhum evento.<a href="/create"> Criar evento</a></p>
            @endif
            @if (count($eventasparticipant)>0)
                <p>Suas participações</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Participantes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventasparticipant as $participant)
                            <tr>
                                <th scope="row">{{$participant->id}}</th>
                                <th scope="row"><a href="/event/{{$participant->id}}">{{$participant->nomeEvento}}</a></th>
                                <th scope="row">{{count($participant->users)}}</th>
                                <th scope="row" >
                                    <form class="bform" action="/event/removeJoin/{{$participant->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button>sair</button>
                                    </form>
                            </th>
                        </tr>
                        @endforeach
                    @else
                    </hr><hr>
                        <p>Cê ainda não participa de eventos. <a href="/">Veja alguns eventos</a></p>
                    @endif
                </div>
                </div>
            </div>
        </div>
        </div>
  <!--SCRIPTS-->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
    integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
    crossorigin="anonymous"></script>
    <script src="js/consultaCEP.js"></script>
  <script src="js/popUp.js"></script>
</body>

</html>