<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function()
// {
//     return view('welcome');
// });
Route::get('/test', function(){
  return view('test');
});
Route::get('/', 'CompteController@index');

Route::get('/bonjour/{nom}',function(){
  return view('bonjour',['nom' => request('nom')]);
});
//Inscription
Route::get('/inscription', 'InscriptionController@formulaire');
Route::post('/inscription', 'InscriptionController@traitement');
//Fin Inscription

//Connexion
Route::get('/connexion', 'ConnexionController@formulaire');
Route::post('/connexion', 'ConnexionController@traitement');
//Fin connexion


Route::group([
  'middleware' => 'App\Http\Middleware\Auth'
], function(){
  Route::get('/utilisateurs', 'UtilisateursController@liste');
  Route::get('/moncompte', 'CompteController@accueil');
  Route::get('/add-utilisateur', 'InscriptionController@formulaire');
  Route::post('/add-utilisateur', 'InscriptionController@traitement');
  //mise à jour du profil
  Route::get('/profil', 'CompteController@formulaireprofil');
  Route::post('/update_profil','CompteController@updateprofil');
  Route::post('/modification-password', 'CompteController@modificationpassword');
  //fin

  Route::get('/deconnexion', 'CompteController@deconnexion');
  Route::get('/accueil', function(){
    return view('accueil');
  });

});
