<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
//Login
    //Login
        Route::get('/login', [EventController::class, 'login'])->name('login');
        Route::post('/Forms-login', [EventController::class, 'loginForms'])->name('login.login');
    //Logout
        Route::post('/logout', [EventController::class, 'logout']);
    //Esqueceu senha
        Route::get('/esqueceuSenha', [EventController::class, 'indexSenha']);
        Route::post('/esqueceuSenha-Forms-email', [EventController::class, 'esqueceuSenhaFormsEmail'])->name('recSenhaToEmail');
        Route::put('/esqueceuSenha-Forms', [EventController::class, 'esqueceuSenhaForms'])->name('recSenhaEntidade');
//Login
//cadastro de usuario
    Route::get('/register', [EventController::class, 'register'])->name('register'); 
    Route::POST('/Forms-register', [EventController::class, 'registerForms'])->name('register');
//cadastro de usuario
//Editar usuario
    Route::get('/editarUsuario/{id}', [EventController::class, 'editarUsuario']); 
    Route::POST('/update', [EventController::class, 'editarUsuarioForms']);
//Editar  usuario
//Listagem e informação de evento
    //PUBLICO
        Route::get('/', [EventController::class, 'event']);
        Route::get('/event/{id}',[EventController::class, 'show']);
    //PUBLICO
    //PRIVADO
        Route::post('/events',[EventController::class, 'store'])->middleware('auth');
        Route::get('/dashboard',[EventController::class, 'dashboard'])->middleware('auth');
    //PRIVADO
//Listagem e informação de evento

//middleware vai apartir do click no link até o view (middle = mediador)
//Criar Evento
    Route::get('/create',[EventController::class, 'create'])->middleware('auth');
//Criar Evento

//Deletar
    Route::delete('/event/{id}',[EventController::class,'deletar'])->middleware('auth');
//Deletar

//Editar
    Route::GET('/event/edit/{id}',[EventController::class, 'edit'])->middleware('auth');
    Route::put('/event/update/{id}',[EventController::class, 'update'])->middleware('auth');
//Editar

//Participar
    Route::post('/event/join/{id}',[EventController::class, 'join'])->middleware('auth');
    Route::delete('/event/removeJoin/{id}',[EventController::class,'removeJoin'])->middleware('auth');
//Participar