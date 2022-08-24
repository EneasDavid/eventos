<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    function index(){
        return view("welcon");
    }
    function aprendendo($id=null){
        $nome='Enéas';
        $idade=17;
        $contador=[1,2,3,4,5];
        $nomes=['David','Antonio','Lucas'];
        $busca=request('search');
        return view('learning',['nome'=>$nome,
                                'idade'=>$idade,
                                'profissao'=>'programador B-End',
                                'array'=>$contador,
                                'nomes'=>$nomes,
                                'id'=>$id, 
                                'busca'=>$busca]);  
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $Events= Event::all();
        //$request recebe todos os dados provindos do formulario, pike array
        //Criadno a entidade
        $event = new Event;
        //Passando os valores da web/request pro bd
        $event->title=$request->title;
        $event->cidade=$request->cidade;
        $event->descricao=$request->descricao;
        $event->privado=$request->privado;
        $event->items=$request->items;
        $event->date=$request->date;
        //Upload de imagem
        if($request->hasfile('imagem') && $request->file('imagem')->isValid()){
            $requestImagem=$request->imagem;
            //Pega a imagem
            $extension=$requestImagem->extension();
            //pega a extensão
            $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now").".".$extension);
            //cria o nome da imagem
            $request->imagem->move(public_path('img/events'),$imagemName);
            //salva no bd
            $event->imagem=$imagemName;
        }

        $user=auth()->user();
        $event->user_id=$user->id;
        //Salvando os dados
        $event->save();
        //redirecionando a página
        return redirect('/')->with('msg','Evento criado');

    }

    public function event(){
        $busca=request('search');
        if($busca){
            $Events=Event::where([
                ['title', 'like', '%'.$busca.'%']
                ])->get();
        }else{
            $Events=Event::all();
        }
        return view('events.events',['events'=>$Events,'busca'=>$busca]);
    }

    public function show($id){
        $event=Event::findOrfail($id);
        $user=auth()->user();
        $existeUserJoin=false;
        if($user){
            //já pode entrar com tela de usuario
            $userEvents=$user->eventAsParticipant->toArray();
            foreach($userEvents as $userEvent){
                if($userEvent['id']==$id){
                    $existeUserJoin=true;
                }
            }
        }

        $eventOwner=User::where([['id',$event->user_id]])->first()->toArray(); //first serve pra para a busca na primeira corespondencia
        //EventOwner = dono do evento
        return view('events.show',['event'=>$event,'eventOwner'=>$eventOwner,'JaParticipa'=>$existeUserJoin]);
    }

    public function dashboard(){
        $user=auth()->user();
        $events=$user->events;
        $eventAsParticipant=$user->eventAsParticipant;

        return view('events.dashboard',['events'=>$events,'eventasparticipant'=>$eventAsParticipant]);
    }

    public function deletar($id){
        $user=auth()->user();
        $event=Event::findOrFail($id);
        //Esse if serve pra bloquear acessoas de terceiros sem propriedade administrador
        if($user->id!=$event->user->id){
            return redirect('/dashboard')->with('msg','Esse evento não pertence a você');
        }
        $event->delete();
        return redirect('/dashboard')->with('msg','excluido com sucesso');
    }

    public function edit($id){
        $event=Event::findOrFail($id);
        $user=auth()->user();
        if($user->id!=$event->user->id){
            return redirect('/dashboard')->with('msg','Esse evento não pertence a você');
        }
           return view('events.edit',['event'=>$event]);
    }

    public function update(request $request){
        $date=$request->all();
        //Upload de imagem
        if($request->hasfile('imagem') && $request->file('imagem')->isValid()){
            $requestImagem=$request->imagem;
            //Pega a imagem
            $extension=$requestImagem->extension();
            //pega a extensão
            $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now").".".$extension);
            //cria o nome da imagem
            $request->imagem->move(public_path('img/events'),$imagemName);
            //salva no bd
            $date['imagem']=$imagemName;
        }
        Event::findOrFail($request->id)->update($date);
        $date=$request->all();
        return redirect('/dashboard')->with('msg','Editado com sucesso');
        
    }

    public function join($id){
        $user=auth()->user();
        $user->eventAsParticipant()->attach($id);
        $event=Event::findOrFail($id);
        return redirect('/dashboard')->with('msg','Sua presença no evento ' . $event->title . ' foi confirmada');
    }  

    public function removeJoin($id){
        $user=auth()->user();
        $user->eventAsParticipant()->detach($id);
        $event=Event::findOrFail($id);
        
        return redirect('/dashboard')->with('msg','Sua presença no evento '.$event->title.' foi removida');
    }
}
