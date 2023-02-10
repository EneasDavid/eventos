<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Academias Go</title>
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
  <div class="container col-md-6 form-container ">
</br>
</br>
</br>
</br>
</br>
   <h1 class="col-md-8 m-auto" style="width: max-content;">Login</h1>
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
</br>
    <form class="col-md-8 m-auto" action="{{route('login.login')}}" method="post">
      @csrf
      <div class="mb-3">
         <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email:" required>
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Senha:" required>
      </div>
      <div class="mb-3 row">
        <div class="col-md-6">
          <a href="/esqueceuSenha" >Esqueci Senha</a>
        </div>
        <div class="col-md-6">
        <button class="btn btn-primary mb-3" type="submit" style="float: right;">Entrar</input>
        </div>
      </div>
      <div class="mb-3">
          <a class="btn btn-primary mb-3" href="/register" >Cadastra-se</a>
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
  

</body>
</body>

</html>