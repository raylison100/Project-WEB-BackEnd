<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return redirect('/');
});

Route::group(['prefix' => 'betterworld'], function () {

    // New User
    Route::post('users', 'UsersController@store');// Create a user.

    //  Gerenciamento de login
    Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->middleware('check-email-verification', 'insert-scope');//Login de usuario;
    Route::get('activate/{token}', 'Auth\AuthController@enableSignUp');//Ativação de usuario via token em email.

    // Gerenciamento de password
    Route::group(['prefix' => 'password'], function () {

        Route::post('email', 'Auth\PasswordResetController@create');// Solicitação de reset de senha passando email.
        Route::get('find/{token}', 'Auth\PasswordResetController@find');// Validação de token para reset de senha.
        Route::post('reset', 'Auth\PasswordResetController@reset');// Recebendo dados para auteração de senha.
    });

    // Routes Autenticadas
    Route::group(['middleware' => ['auth:api', 'scope:COMMON']], function () {

        // Authenticated
        Route::get('auth', 'Auth\AuthController@getUserAuthenticated');// Recupera usuario logado.
        Route::delete('oauth/tokens', 'Auth\AuthController@destroyToken');//  Destroi token de acesso.

        // User
        Route::get('users', 'UsersController@index');// Return all users.
        Route::get('users/participant', 'UsersController@eventsParticipants');// Return all events for a user.
        Route::get('users/{id}', 'UsersController@show');// Return a users.
        Route::put('users/{id}', 'UsersController@update');// Update a user.
        Route::delete('users/{id}', 'UsersController@destroy');// Delete a user.

        //Events
        Route::get('events', 'EventsController@index');// Busca todos os events
        Route::get('events/{id}', 'EventsController@show'); //Busca events id;
        Route::post('events', 'EventsController@store');// Busca todos os events
        Route::put('events/{id}', 'EventsController@update');// Atualiza um events
        Route::put('events/participant/{id}', 'EventsController@participantAdd');// Adicona um user a um event

        //Messages
        Route::post('mensagens', 'MessagesController@store');// Criação de messagem
        Route::put('mensagens/{id}', 'MessagesController@update');// Edição de messagem

    });
});
