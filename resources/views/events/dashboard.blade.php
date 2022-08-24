<div class="col-md-10 offset-md-1 dashbord-title-container">
    <a href="/">home</a>
    <p>Meus eventos</p>
    @if (session('msg'))
        <p class="msg">{{session('msg')}}</p>
    @endif
    <div class="col-md-10 offset-md-1 dashbord-events-container">
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
                            <th scope="row"><a href="/event/{{$event->id}}">{{$event->title}}</a></th>
                            <th scope="row">{{count($event->users)}}</th>
                            <th scope="row" ><a href="/event/edit/{{$event->id}}">Editar</a>|
                            <a class="btn btn-infoedit-btn" href="/event/{{$event->id}}">
                                <form action="/event/{{$event->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                                </form>
                            </a>
                        </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>você ainda não faz de nenhum evento</p>
            <a href="/create">Criar evento</a>
        @endif
        @if (count($eventasparticipant)>0)
            <p>cê perticipa de evento</p>
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
                            <th scope="row"><a href="/event/{{$participant->id}}">{{$participant->title}}</a></th>
                            <th scope="row" >
                                 <form action="/event/removeJoin/{{$participant->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>sair</button>
                                </form>
                        </th>
                    </tr>
                    @endforeach
        @else
            <p>Cê inda não participa de eventos. <a href="/">Veja alguns eventos</a></p>
        @endif
    </div>
</div>