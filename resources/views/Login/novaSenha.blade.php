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
    <div class="container col-md-6 form-container ">
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
        <h1 class="mb-5 m-auto">Nova Senha</h1>
        <form class="col-md-8 m-auto" action="{{route('recSenhaEntidade')}}" method="POST">
            @csrf   
            @method('PUT') 
            <input type="hidden" name="entidade" value="{{$entidade->id}}">
            <div class="mb-3">
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nova Senha:">
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Confirmar Senha:">
            </div>
            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="p-2 bd-highlight">
                    <button type="submit" class="btn btn-primary mb-3">Enviar</button>
                </div>
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
</body>

</html>