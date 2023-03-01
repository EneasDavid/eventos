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
            <a class="navbar-brand" href="/">HostEvent</a>
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
                                <a class="nav-link" href="/dashboard">Meus eventos</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link active" href="/create">Criar eventos</a>
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
      <h1 class="col-md-8 m-auto" style="width: max-content;">Criar</h1>
      <div id="event-create-conteiner" class="col-md-6 offset-md-3">
        @if (session('msg'))
        <div class="alert alert-danger">
          {{ session('msg') }}
        </div>
        @endif
        <h1>Crie seu evento</h1>
        <form action="/events" method="POST" enctype="multipart/form-data">
          @csrf
        {{--Diretiva obrigatoria no LARAVEL, senão não permite adicionar dados no bd--}}
        {{--enctype é obrigatorio ter, caso queira receber arrquivos do formulario--}}
        </hr><hr>
        <div class="mb-3 row">
          <label for="date"><strong>Dados do Evento</strong></label>
          <div class="col-md-12 mb-4">
            <label for="imagem">Foto do evento*</label>
            <input type="file" class="form-control-file" id="imagem" name="imagem" >
        </div>
        <div class="col-md-8 mb-4">
          <input type="text" class="form-control" id="title" name="nomeEvento" placeholder="Digite o nome do evento *">
        </div>
        <div class="col-md-4 mb-4">
          <input type="number" step="0" min="1" class="form-control" id="title" name="quantidadeP" placeholder="Quantidade de participantes">
        </div>
        <div class="col-md-6 mb-4">
           <label for="date">Data do evento *</label>
           <input  class="form-control" type="date" name="date" id="date">
        </div>
        <div class="col-md-6 mb-4">
        <label for="date">Horario do evento *</label>
          <input class="form-control" type="time" id="appt" name="time" smin="00:01" max="23:59" required>          
        </div>
      </div>
      </hr><hr>
      <div class="mb-3 row">
        <label for="date"><strong>Endereço do Evento</strong></label>
           <div class="col-md-4 mb-4">
            <input type="text" class="form-control" id="cep" placeholder="Digite seu CEP *"  name="cep" maxlength="9" minlength="8" data-cep>
          </div>
          <div class="col-md-4 mb-4">
            <input type="text" class="form-control" id="cidade" placeholder="Cidade *" name="cidade" readonly >
          </div>
          <div class="col-md-4 mb-4">
            <input type="text" class="form-control" id="uf" name="uf" name="uf" placeholder="Estado *" readonly >
          </div>
          <div class="col-md-6 mb-4">
            <input type="text" class="form-control" id="rua" placeholder="Rua *" name="rua" readonly >
          </div>
          <div class="col-md-6 mb-4">
            <input type="text" class="form-control" id="bairro" placeholder="Bairro *" name="bairro" readonly >
          </div>
          <div class="col-md-12 mb-4">
            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
          </div>
        </div>
        </hr><hr>
      <div class="mb-3 row">
          <label for="date"><strong>Dados adicionais do Evento</strong></label>
          
          <div class="from-grup col-md-6">
              <label for="items"><strong>Items</strong></label>
              <div class="from-grup">
                  <input style="width: auto!important;" type="checkbox" name="items[]" value="palco">palco
                </div>
              <div class="from-grup">
                  <input style="width: auto!important;" type="checkbox" name="items[]" value="bebidas">bebidas
                </div>
              <div class="from-grup">
                  <input style="width: auto!important;" type="checkbox" name="items[]" value="brindes">brindes
              </div>
              <div class="from-grup">
                  <input style="width: auto!important;" type="checkbox" name="items[]" value="cadeiras">cadeiras
              </div>
          </div>
          <div class="form-grup col-md-6" style="display:grid">
              <label for="descricao">Descrição *</label>
              <textarea name="descricao" id="descricao" class="from-controller"></textarea>   
          </div>
      </div>
        <button type="submit" class="btn btn-primary mb-3" style="float: right;">Criar</button>
    </form>
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
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="js/script.js"></script>
  <script 
  src = "https://code.jquery.com/jquery-3.4.1.min.js" integridade = "sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin = "anonymous" > </script>
  <script src="js/consultaCEP.js"></script>


</body>

</html>