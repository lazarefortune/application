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
  //ajouter un utilisateur
  Route::get('/add-utilisateur', 'InscriptionController@formulaire');
  Route::post('/add-utilisateur', 'InscriptionController@traitement');
  //ajouter un client
  Route::get('/add-client', 'ClientController@formulaire');
  Route::post('/add-client', 'ClientController@traitement');

  Route::get('/mes-clients', 'ClientController@liste');
  //profil du client
  Route::get('/profil-client/{id_client}','ClientController@profilclient');
  Route::post('/profil-client/{id_client}','ClientController@updateclient');
  //mise à jour du profil utilisateur
  Route::get('/profil', 'CompteController@formulaireprofil');
  Route::post('/update_profil','CompteController@updateprofil');
  Route::post('/modification-password', 'CompteController@modificationpassword');
  //fin
  //supprimer un utilisateur
  Route::get('/delete-utilisateur/{id_utilisateur}','CompteController@delete_utilisateur');

  //supprimer un clients
  Route::get('/delete-client/{id_client}','ClientController@deleteclient');

  //ajouter un emprunt
  Route::get('/add-emprunt','EmpruntController@formulaire');
  Route::post('/add-emprunt','EmpruntController@traitement');

  Route::get('/delete-emprunt/{id_emprunt}','EmpruntController@delete_emprunt');

  Route::get('/deconnexion', 'CompteController@deconnexion');
  Route::get('/accueil', function(){
    return view('accueil');
  });

});
