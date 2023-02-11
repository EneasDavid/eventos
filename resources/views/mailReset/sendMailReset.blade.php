<div class="container" style="padding-bottom:.8rem">
    <div class="col-md-12 centered mx-auto ">
        <div style="display: flex;flex-direction: column;justify-content: space-between;align-items: center;">
            <span class="navbar-brand">Event host</span>
            <h4>Olá {{$destinatario->name}}, estamos retornando o seu contato para redefinir sua senha</h4>
            <h1>Caso não tenha solicitado, apenas ignore esta mensagem, caso contrario, clique no botão a baixo para redefinir sua senha</h1>
            <a href="http://127.0.0.1:8000/esqueceuSenha-Forms/{{$idUser}}" class="btn mt-4">REDEFINIR SENHA</a>
        </div>
    </div>
</div>