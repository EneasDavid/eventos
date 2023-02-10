<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Host Event</title>
  <!--CSS Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!--CSS -->
</head>

<body>
  <!--NAVBAR-->
  <nav class="navbar-dark bg-dark navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">HostEvent</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="float:right">
        <!--LINKS-->
        <li class="nav-item">
          <a class="nav-link" href="/login">logar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">cadastrar</a>
        </li>
      </ul>       
    </div>
  </nav>
  <div class="m-auto container col-md-6 form-container ">
   <h1 class="col-md-8 m-auto" style="width: max-content;">Cadastro de Usuario</h1>
   <div class="col-md-8 m-auto">
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
   </div>
    <form class="col-md-8 m-auto" action="{{route('register')}}" enctype="multipart/form-data" method="POST">
      @csrf
      </hr><hr>
      <div class="mb-3">
        <label for="imagem">Foto do usuario</label>
        <input type="file" class="form-controll-file" id="imagem" name="foto" >
      </div>      
      <div class="mb-3">
         <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Digite seu nome:*" >
      </div>      
      <div class="mb-3">
         <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="E-mail:*" >
      </div>
      <div class="mb-3">
         <input type="email" class="form-control" name="Confirme_email" placeholder="Confirme seu E-mail:*" >
      </div>
      <div class="mb-3 row">
        <div class="col-md-6 mb-3">
          <input type="password" class="form-control" name="password" placeholder="Senha:*" >
        </div>
        <div class="col-md-6 mb-3">
           <input type="password" class="form-control" name="Confirme_password" placeholder="Confirme sua senha:*" >
        </div>
      </div>
      </hr><hr>
      <div class="mb-3 row">
        <div class="col-md-6">
          <input type="tel" class="mb-3 form-control" name="telefone"  placeholder="(xx) xxxxx-xxxx*">
        </div>
        <div class="col-md-6">
          <input type="date" class="mb-3 form-control" name="dataNascimento" >
        </div>
      </div>
      </hr><hr>
      <div class="mb-3 row">
           <div class="col-md-5 mb-4">
            <input type="text" class="form-control" id="cep" placeholder="Digite seu CEP *"  name="cep" maxlength="9" minlength="8" data-cep>
          </div>
          <div class="col-md-5 mb-4">
            <input type="text" class="form-control" id="rua" placeholder="Rua *" name="rua" readonly >
          </div>
          <div class="col-md-2 mb-4">
            <input type="text" class="form-control" id="numero" placeholder="Nº *" name="numeroCasa" >
          </div>
          <div class="col-md-4 mb-4">
            <input type="text" class="form-control" id="bairro" placeholder="Bairro *" name="bairro" readonly >
          </div>
          <div class="col-md-4 mb-4">
            <input type="text" class="form-control" id="cidade" placeholder="Cidade *" name="cidade" readonly >
          </div>
          <div class="col-md-4 mb-4">
            <input type="text" class="form-control" id="uf" name="uf" name="uf" placeholder="Estado *" readonly >
          </div>
          <div class="col-md-12 mb-4">
            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
          </div>
      </div>
    <div class="p-2 bd-highlight" style="float:right">
      <button class="btn btn-primary mb-3" type="submit">Cadastra-se</button>
    </div>
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
    <script src="js/jquery.js"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="js/script.js"></script>
  <script 
  src = "https://code.jquery.com/jquery-3.4.1.min.js" integridade = "sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin = "anonymous" > </script>
  <script src="js/consultaCEP.js"></script>
  

</body>
</body>

</html>