<?php
//php artisan serve - 'ligar' o site
//php astisan make:controller nomeDaEntidade - cria o controler
//php artisan make:migration nomeDaMigrate- a migrate que futuramente vai interargir com o bd
//php artisan migrate:status - ver como tá as tabelas criadas
//php artisan migrate - criar a tabela no bd
//php artisan migrate:fresh - Deleta todas as migrates e atualização a estrutura delas
//php artisan make:migration add_category_to_produto_table - serve parar modificar uma tabela (criando outra que herda seu contrutor) sem perder os dados
//php artisan migrate:rollback - apaga a ultima modificação do bd
//php artisan migrate:reset - apaga todo o bd
//php artisan migrate:refresh - exclui e adiciona todas as tabelas de novo
//php artisna make:model nomeModel - pra criar retorno com o bd
//composer require laravel/jetstream - pacore open souce
//php artisan jetstream:install livewire - pra quem usa acess (precisa do Node js no path do pc)
//npm install - pra instalar a interface de login
//npm run dev - pra iniciar ela

//Dica: Sempre que for criar um controller ou Migrate usar com o php rodando

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


//Direto pelo routes
/*Route::get('/a/{id?}/',function($id=null){
    //? - Caracter opcional, não obriga a passar a informação pela URL;
    // Ainda é preciso adicionar um valor padrão a variavel da function, nesse caso foi o null
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
                            //Pegando valores pela url - Id está sendo pego pelo URL
});*/

//Usando o controller
Route::get('/a/{id?}', [EventController::class, 'aprendendo']);

Route::get('/', [EventController::class, 'event']);
Route::get('/event/{id}',[EventController::class, 'show']);
Route::get('/create',[EventController::class, 'create'])->middleware('auth');
//middleware vai apartir do click no link até o view (middle = mediador)
Route::post('/events',[EventController::class, 'store'])->middleware('auth');
Route::delete('/event/{id}',[EventController::class,'deletar'])->middleware('auth');
Route::GET('/event/edit/{id}',[EventController::class, 'edit'])->middleware('auth');
Route::put('/event/update/{id}',[EventController::class, 'update'])->middleware('auth');
Route::get('/dashboard',[EventController::class, 'dashboard'])->middleware('auth');
Route::post('/event/join/{id}',[EventController::class, 'join'])->middleware('auth');
Route::delete('/event/removeJoin/{id}',[EventController::class,'removeJoin'])->middleware('auth');
