<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Host Event</title>
  <!--CSS Bootstrap-->
  <link rel="stylesheet" href="/css/style.css">
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
            <!--LINKS-->
            <div class="collapse navbar-collapse" id="navbarNav" style="justify-content: flex-end;">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="float: right;">
                @auth
                            {{--auth serve pra mostrar coisas pra quem tá logado--}}
                            <li class="nav-item active">
                                <a class="nav-link" href="/dashboard" style="cursor:pointer">Meus eventos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/create" style="cursor:pointer">Criar eventos</a>
                            </li>
                            <li class="nav-item">
                                <form action="/logout" method="post">
                                @csrf
                                    <a class="nav-link" style="cursor:pointer" href="/" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                                    {{--closest('form') fecha o formulario mais perto--}}
                                </form>
                            </li>
                        @endauth
                        @guest
                        {{--guest serve pra mostrar coisas pra pessoas não logadas--}}
                        <li class="nav-item">
                                <a class="nav-link" onclick="chamaPopUp()" style="cursor:pointer">LOGAR</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="chamaPopUp()" style="cursor:pointer">CADASTRAR</a>
                            </li>
                        @endguest
            </ul>       
         </div>
        </nav>
        <div class="modal pagina" id="modalExemplo" tabindex="-1" role="dialog" style="margin: 0!important;" aria-labelledby="exampleModalLabel" aria-hidden="true" popUp-cadastrar-tag> 
        <div class="wrapper">
            <div class="container">
                <button type="button" class="btn-close btn-close-white" aria-label="Close" data-dismiss="modal" style="width: inherit;" onclick="removerPopUp()"></button>
                <div class="sign-up-container">
                    <form class="form" action="{{route('register')}}" enctype="multipart/form-data" method="POST">
                    @if ($errors->any())
                        <div>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @break;
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                        @endif
                        @csrf
                        <h1>CRIE SUA CONTA</h1>
                        <span>informe seus dados</span>
                        <input type="text" name="name" aria-describedby="emailHelp" placeholder="NOME*">
                        <input type="email" name="email" aria-describedby="emailHelp" placeholder="EMAIL*">
                        <input type="email" name="email" aria-describedby="emailHelp" placeholder="CONFIRME O EMAIL*">
                        <input type="password" name="password" aria-describedby="emailHelp" placeholder="SENHA*">
                        <button class="form_btn">CADASTRO</button>
                    </form>
                </div>
                <div class="sign-in-container">
                    <form class="form" action="{{route('login.login')}}" method="post">
                        @if ($errors->any())
                        <div>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @break;
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                        @endif
                        @csrf
                        <h1>Entrar</h1>
                        <span>Use sua conta</span>
                        <input type="email" name="email" aria-describedby="emailHelp" placeholder="Email:" required>
                        <input type="password" name="password" placeholder="Senha:" required>
                        <div class="mb-3 row" style="align-items: center !important;">
                            <div class="col-md-6">
                                <a href="/esqueceuSenha" >ESQUECI SENHA</a>
                            </div>
                            <div class="col-md-6">
                                <button class="form_btn" type="submit" style="float: right;">ENTRAR</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay-left">
                        <h1>JÁ TEM UMA CONTA?</h1>
                        <p>Faça seu login para ter acesso a mais funcionalidades em nosso site!</p>
                        <button id="signIn" class="overlay_btn">ENTRAR</button>
                    </div>
                    <div class="overlay-right">
                        <h1>OLÁ AMIGO</h1>
                        <p>Ainda não tem uma conta? Cadastre-se agora e recessa acesso a funcionalidades exclusivas a usuarios do nosso site!</p>
                        <button id="signUp" class="overlay_btn">CADASTRE-SE</button>
                    </div>
                </div>
            </div>
            </div>
            <script>
                const signUpBtn = document.getElementById("signUp");
                const signInBtn = document.getElementById("signIn");
                const container = document.querySelector(".container");
                signUpBtn.addEventListener("click",() =>{
                    container.classList.add("right-panel-active");
                })
                signInBtn.addEventListener("click",() =>{
                    container.classList.remove("right-panel-active")
                })
         </script>
        </div>
    <div class="col-md-10 offset-md-1 pt-2">
      <div class="row " style="height: 20rem;border-radius: 30px">
        <img class="img-fluid img-center-show" style="border-radius: 30px" src="/img/events/{{$event->imagem}}" alt="Não foi possivel carregar a imagem">
      </div>
    </div>
    <div id="info-conteiner" style="margin-right:12rem;margin-left:12rem">
        <span class="font" style="display: flex;justify-content: space-around;">{{$event->nomeEvento}} - {{$semanaD[date('l', strtotime($event->date))]}}, {{date('d/m/y', strtotime($event->date))}}</span>
        <hr></hr>
        <p class="m-0"><b>{{$event->cidade}} - {{$event->uf}}</b></p>
        <p>às {{date('h:i', strtotime($event->time))}} Hrs</p>
        <hr></hr>
        <span class="font">Descrição do Evento</span>
        @if($event->integranteQuantidade!=null)
        <p><b>{{$event->integranteQuantidadePreenchidas}} de {{$event->integranteQuantidade}} vagas </b>já foram preenchidas</p>
        @endif
        <div style="display: flex;flex-direction: row;justify-content: space-around;align-items: center;"> 
          <p>{{$event->descricao}}</p>
          <div style="display: flex;flex-direction: column;align-items: stretch;">
          <p><b>Itens</b></p>
          @if(empty($event->items))
          <p><i>Não há intens nesse evento</i></p>
          @else
          @foreach ($event->items as $item)
            <li><i>{{$item}}</i></li>
            @endforeach
            @endif
          </div>
        </div>
        <hr></hr>
        <div style="display: flex;flex-direction: column-reverse;;justify-content: center;align-items: center;">
          <p style="margin-right: 10px;"><b>Organizador: </b>@if($eventOwner['id']==$usuario['id']) Você @else {{$eventOwner['name']}} @endif</p>
          @if ($eventOwner['id']==$usuario['id'])
            <p><b>Participantes: </b>{{count($event->users)}}</p>
          @elseif($event->finalizada)
              <p><b>EVENTO FINALIZADO</b></p>
          @elseif(isset($event->integranteQuantidade) and $event->integranteQuantidadePreenchidas==$event->integranteQuantidade)
                <p><b>EVENTO LOTADO</b></p>
          @elseif (!$JaParticipa)
              <form action="/event/join/{{$event->id}}" method="POST">
                @csrf 
                <a class="btn btn-primary mb-3" href="/event/join/{{$event->id}}" 
                id="event-submit" 
                onclick="event.preventDefault();
                this.closest('form').submit();">
               Participar
               </a>
              </form>
          @elseif ($JaParticipa)
              <p><i><b>Você já participa desse evento</b></i></p>
          @endif
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
    <script src="/js/popUp.js"></script>


</body>

</html>