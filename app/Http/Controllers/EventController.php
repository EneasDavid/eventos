<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    //Login
        public function login()
        {
            $user=auth()->user();
            $busca=request('search');
            if($busca){
                $Events=Event::where([
                    ['nomeEvento', 'like', '%'.$busca.'%']
                    ])->whereNotIn('finalizada',[1])->get();
            }else{
                $Events=Event::whereNotIn('finalizada',[1])->get();
            }
            return view('eventsLogin',['user'=>$user,'events'=>$Events,'busca'=>$busca]);
        }
            public function loginForms(Request $request)
        {
            $entidade=User::where('email',$request->email)->first(); 
                if($entidade && Hash::check($request->password,$entidade->password)){
                    Auth::loginUsingId($entidade->id);
                    return redirect('/');
                }else{
                    return redirect()->back()->with('danger','Email ou senha invalida!');
                }
        }
    //Esqueceu senha
     public function indexSenha()
     {
         return view('Login.esqueceusenha');            
     }
     public function esqueceuSenhaFormsEmail(Request $request)
     {
         $email=$request->email;
         $usuario=User::where('email', 'like', '%'.$email.'%')->first();
         if(empty($usuario)){
             return redirect('/esqueceuSenha')->with('msg','Esse usuario não existe!');
        }
        Mail::send(new \App\Mail\SendMail($usuario));
        return redirect('/esqueceuSenha')->with('success','Enviamos um email com as instruções para redefinir sua senha');
     }
     public function verificaIdsenhaForms($id){
        $user=user::all();
        foreach($user as $destinatario){
            if(Hash::check($destinatario->id,$id)){
                return view('Login.novaSenha',['entidade'=>$destinatario]);
            }
        }
        return back()->with('danger','usuario não encontrado');
     }
     public function esqueceuSenhaForms (Request $request)
     {
         User::findOrFail($request->entidade)->update([
             'password'=>Hash::make($request->password),
         ]);  
         return redirect('/');
     }
    //Logout
     public function logout ()
     {
         Auth::logout();
         return redirect('/');
     }
    //cadastro usuario
        public function registerForms(Request $request){
            $usuarios = new User;
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
                'dataNascimento'=>'required',
                'telefone'=>'required',
                'cep'=>'required',
                'rua'=>'required',
                'numeroCasa'=>'required',
            ],[
                'required' => 'Os campos marcados com * são obrigartorios!',
            ]);
            $usuarios->name=$request->name;
            $usuarios->email=$request->email;
            $usuarios->password=Hash::make($request->password);
            $usuarios->dataNascimento=$request->dataNascimento;
            $usuarios->telefone=$request->telefone;
            $usuarios->cep=str_replace("-","",$request->cep);
            $usuarios->rua=$request->rua;
            $usuarios->numeroCasa=$request->numeroCasa;
            $usuarios->complemento=$request->complemento;
            $usuarios->bairro=$request->bairro;
            $usuarios->cidade=$request->cidade;
            $usuarios->uf=$request->uf;
            if($request->hasfile('foto') && $request->file('foto')->isValid()){
                $requestImagem=$request->foto;
                //Pega a imagem
                $extension=$requestImagem->extension();
                //pega a extensão
                $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now")).".".$extension;
                //cria o nome da imagem
                $request->foto->move(public_path('img/usuarios'),$imagemName);
                //salva no bd
                $date['foto']=$imagemName;
            }
            $usuarios->save();
            Auth::loginUsingId($usuarios->id);
            return redirect('/');
        }    
    //cadastro usuario
    //atualizar usuario
        public function editarUsuario($id){
            $user=user::findOrFail($id);    
            return view('Login.register',['user'=>$user]);
        }
        public function editarUsuarioForms(Request $request){
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'dataNascimento'=>'required',
                'telefone'=>'required',
                'cep'=>'required',
                'rua'=>'required',
                'numeroCasa'=>'required',
            ],[
                'required' => 'Os campos marcados com * são obrigartorios!',
            ]);
            $user=user::findOrFail($_GET['id']);
            if($request->hasfile('foto') && $request->file('foto')->isValid()){
                $requestImagem=$request->foto;
                //Pega a imagem
                $extension=$requestImagem->extension();
                //pega a extensão
                $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now")).".".$extension;
                //cria o nome da imagem
                $request->foto->move(public_path('img/usuarios'),$imagemName);
                //salva no bd
                $imgFoto=$imagemName;
            }else{
                $imgFoto=$user->foto;
            }
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'dataNascimento'=>$request->dataNascimento,
                'telefone'=>$request->telefone,
                'cep'=>str_replace("-","",$request->cep),
                'rua'=>$request->rua,
                'numeroCasa'=>$request->numeroCasa,
                'complemento'=>$request->complemento,
                'bairro'=>$request->bairro,
                'cidade'=>$request->cidade,
                'uf'=>$request->uf,
                'foto'=>$imgFoto
            ]);
            return redirect('/dashboard');
        }
        
    //atualizar usuario
    //Excluir usuario
        public function deletarUser($idUser){
          User::findOrFail($idUser)->delete();
            return redirect('/');
        } 
    //Excluir usuario

        public function create(){
            return view('create');
        }   
        public function store(Request $request){
            //Criadno a entidade
            $event = new Event;
            //Marcar como obrigatorio
            $this->validate($request,[
                'nomeEvento'=>'required',
                'cep'=>'required',
                'rua'=>'required',
                'nomeEvento'=>'required',
                'descricao'=>'required',
                'imagem'=>'required',
                'time'=>'required',
                'date'=>'required',
            ],[
                'required'=>'Os campos marcados com * são obriatorios!']);
            //Passando os valores da web/request pro bd
            $event->nomeEvento=$request->nomeEvento;
            $event->integranteQuantidade=$request->quantidadeP;
            $event->integranteQuantidadePreenchidas=0;
            $event->cep=str_replace("-","",$request->cep);
            $event->rua=$request->rua;
            $event->bairro=$request->bairro;
            $event->cidade=$request->cidade;
            $event->uf=$request->uf;
            $event->complemento=$request->complemento;
            $event->descricao=$request->descricao;
            $event->items=$request->items;
            $event->date=$request->date;
            $event->time=$request->time;
            $event->finalizada=0;
            //Upload de imagem
            if($request->hasfile('imagem') && $request->file('imagem')->isValid()){
                $requestImagem=$request->imagem;
                //Pega a imagem
                $extension=$requestImagem->extension();
                //pega a extensão
                $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now")).".".$extension;
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
        public function event()
        {
            $user=auth()->user();
            $busca=request('search');
            $localizacaoAtual=request('s');
            if($busca){
                $Events=Event::where([
                    ['nomeEvento', 'like', '%'.$busca.'%']
                    ])->whereNotIn('finalizada',[1])->get();
            }else{
                if(!empty($localizacaoAtual)){
                     $Events=Event::whereNotIn('finalizada',[1])->where('uf','like',$localizacaoAtual)->get();
                     if(count($Events)<1){
                         $Events=Event::whereNotIn('finalizada',[1])->get();
                         return redirect('/')->with('msg','parece que não há eventos na sua localidade');
                     }
                }else{
                    $Events=Event::whereNotIn('finalizada',[1])->get();
                }
            }
            return view('events',['user'=>$user,'events'=>$Events,'busca'=>$busca]);
        }

        public function show($id){
            $event=Event::findOrfail($id);
            if(!auth()->user()){
                $user=['id'=>0];
            }else{
                $user=auth()->user();
            }
            $existeUserJoin=false;
            if($user and $user['id']!=0){
                //já pode entrar com tela de usuario
                $userEvents=$user->eventAsParticipant->toArray();
                foreach($userEvents as $userEvent){
                    if($userEvent['id']==$id){
                        $existeUserJoin=true;
                    }
                }
            }
            $semanaDia=['Sunday' => 'Dom.', 
            'Monday' => 'Seg.',
            'Tuesday' => 'Ter.',
            'Wednesday' => 'Quart.',
            'Thursday' => 'Qui.',
            'Friday' => 'Sext.',
            'Saturday' => 'Sáb.'];
            $eventOwner=User::where([['id',$event->user_id]])->first()->toArray(); //first serve pra para a busca na primeira corespondencia
            //EventOwner = dono do evento
            return view('show',['semanaD'=>$semanaDia,'usuario'=>$user,'event'=>$event,'eventOwner'=>$eventOwner,'JaParticipa'=>$existeUserJoin]);
        }

        public function dashboard(){
            $user=auth()->user();
            $events=$user->events;
            $eventAsParticipant=$user->eventAsParticipant;

            return view('dashboard',['user'=>$user,'events'=>$events,'eventasparticipant'=>$eventAsParticipant]);
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
            return view('edit',['event'=>$event]);
        }
        public function finalizarEvento($id){
            Event::findOrFail($id)->update([
                'finalizada'=>1,
            ]);
            return back()->with('msg','Evento finalizado!');
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
            $event->update([
                'integranteQuantidadePreenchidas'=>$event->integranteQuantidadePreenchidas+1,
            ]);
            return redirect('/dashboard')->with('msg','Sua presença no evento '. $event->nomeEvento . ' foi confirmada');
        }  

        public function removeJoin($id){
            $user=auth()->user();
            $user->eventAsParticipant()->detach($id);
            $event=Event::findOrFail($id);
            $event->update([
                'integranteQuantidadePreenchidas'=>$event->integranteQuantidadePreenchidas-1,
            ]);
            return redirect('/dashboard')->with('msg','Sua presença no evento '.$event->nomeEvento.' foi removida');
        }
}
