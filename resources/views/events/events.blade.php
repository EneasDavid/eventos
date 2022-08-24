<p>Ligação com o bd</p>
@auth
    {{--auth serve pra mostrar coisas pra quem tá logado--}}
    <li>
        <a href="/dashboard">Meus eventos</a>
    </li>
    <li>
        <a href="/create">Criar eventos</a>
    </li>
    <li>
        <form action="/logout" method="post">
            @csrf
            <a href="/" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
            {{--closest('form') feia o formulario mais perto--}}
        </form>
    </li>
@endauth
@guest
    {{--guest serve pra mostrar coisas pra pessoas não logadas--}}
    <li>
        <a href="/login">logar</a>
    </li>
    <li>
        <a href="/register">cadastrar</a>
    </li>
@endguest
@if (session('msg'))
    <p class="msg">{{session('msg')}}</p>
@endif
<h1>busca envento</h1>
<form action="/event" method="get">
    <input type="text" name="search" id="search" class="form-control">
</form>
@if ($busca)
    <p>Procurando por {{$busca}}</p>
@else
    <p>Proximos eventos</p>
@endif
@foreach ($events as $event)
    {{--Acesso a propriedades de array--}}
    <img src="/img/events/{{$event->imagem}}" alt="{{$event->title}}"></img>
    <p><b>Id:</b> {{$event->id}}</p>
    <p><b>Título:</b> {{$event->title}} | <b>Descrição:</b> {{$event->descricao}}</p>
    <p><b>Cidade:</b> {{$event->cidade}}</p>
    @if ($event->privado)
        <p>O evento é <b>privado</b></p>
    @else
        <p>O evento é <b>publico</b></p>
    @endif
    <p><b>Participantes:</b> {{count($event->users)}}</p>
    <p><b>Data evento:</b> {{date('d/m/y', strtotime($event->date))}}</p>
    <a href="/event/{{$event->id}}">about</a>
@endforeach
@if (count($events) == 0 && $busca)
    <p>Evento não encontrado</p>
@elseif (count($events) == 0)
    <p>Nenhum evento disponivel</p>
@endif
@if ($busca)
    <a href="/event">Ver todos os eventos</a>
@endif
