<div class="col-md-10 offset-md-1">
    <div class="row">
        <img src="/img/events/{{$event->imagem}}" class="img-fluid" alt="{{$event->imagem}}">
    </div>
    <div id="info-conteiner" class="col-md-6">
        <h1>{{$event->title}}</h1>
        <p><b>Dono do evento: </b> {{$eventOwner['name']}}</p>
        <p><b>Cidade: </b>{{$event->cidade}} | <b>Descrição: </b> {{$event->descricao}}</p>
        @if ($event->privado)
            <p><b>O evento é </b>Privado</p>
        @else
            <p><b>O evento é </b>Publico</p>
        @endif
        <p><b>Itens</b></p>
        @foreach ($event->items as $item)
            <li>{{$item}}</li>
        @endforeach
        <p>{{date('d/m/Y', strtotime($event->date))}}</p>
        @if (!$JaParticipa)
        <form action="/event/join/{{$event->id}}" method="POST">
            @csrf 
            <a href="/event/join/{{$event->id}}" 
                id="event-submit" 
                onclick="event.preventDefault();
                this.closest('form').submit();">
                Participar
            </a>
        @else
        <p>Você já participa desse evento</p>
        @endif
    </form>
    </div>
    <a href="/">Voltar</a>
</div>