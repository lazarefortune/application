<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utilisateurs;
class CompteController extends Controller
{
    public function accueil()
    {
/* auth->check() retourne vrai si la personne est connecté et faux sinon
tandis que auth->guest() retourne vrai si la personne n'est pas connecté et faux sinon
*/

    //  var_dump(auth()->guest());
      if (auth()->guest()) {
        flash("Vous devez vous connecté pour voir cette page")->error();

        return redirect('/connexion');
  /*
        return redirect('/connexion')->withErrors([
          'email' => 'Connecté vous pour voir cette page'
        ]);  */
      }

      return view('mon-compte');
    }

    public function formulaireprofil(){
      return view('profil');
    }

    public function if_exist($val)
    {
      if (Utilisateurs::where($val, request($val))->exists()) {
        return true;
      }
      else {
        return false;
      }
    }

    public function updateprofil(){
      request()-> validate([
        'name' => ['required'],
        'email' => ['required','email'],
      ]);

      if (($this->if_exist('name')) and (request('name') != (auth()->user()->name))) {

          if (($this->if_exist('email')) and (request('email') != (auth()->user()->email))) {

              return back()->withInput()-> withErrors([
                'name' => 'Ce nom existe déjà!',
                'email' => 'Cette adresse mail existe déjà!'
              ]);

          }else{
          $affected = DB::update('update utilisateurs set email = ? where id = ?', [request('email'),(auth()->user()->id)]);
          flash('Votre compte a été mis à jour avec succès!')->success();
          return back()->withInput()-> withErrors([
            'name' => 'Ce nom existe déjà!'
          ]);
        }
      }else{

        //update le nom
        $affected = DB::update('update utilisateurs set name = ? where id = ?', [request('name'),(auth()->user()->id)]);
        flash('Votre compte a été mis à jour avec succès!')->success();
        if (($this->if_exist('email')) and (request('email') != (auth()->user()->email))) {

            return back()->withInput()-> withErrors([
              'email' => 'Cette adresse mail existe déjà!'
            ]);
        }else{
          //update email
          $affected = DB::update('update utilisateurs set email = ? where id = ?', [request('email'),(auth()->user()->id)]);

        }
      }


/*
      $affected = DB::update('update utilisateurs set name = ? where id = ?', [request('name'),(auth()->user()->id)]);
      $affected = DB::update('update utilisateurs set email = ? where id = ?', [request('email'),(auth()->user()->id)]);

      flash('Votre compte a été mis à jour avec succès!')->success();*/
      return redirect('/profil');
    }

    public function index()
    {
      if (auth()->guest()) {
        return redirect('/connexion');
      }

      return view('accueil');
    }

    public function deconnexion()
    {
      auth()->logout();
      flash("Deconnexion avec succès")->success();
      return redirect('/connexion');
    }

    public function modificationpassword()
    {
      request()->validate([
        'password_old' => ['required'],
        'passwordnew'=> ['required'],
        'passwordnew_confirmation' => ['required']
      ]);
      $resultat = password_verify(request('password_old'), (auth()->user()->password));

      if ($resultat) {
        request()->validate([
          'passwordnew'=> ['required','confirmed', 'min:3'],
          'passwordnew_confirmation' => ['required']
        ]);

        auth()->user()->update([
          'password' => bcrypt(request('passwordnew'))
        ]);

        flash("Mot de passe changé avec succès")->success();

        return redirect('/profil');
      }
      else {
        return back()->withInput()-> withErrors([
          'password_old' => 'Votre ancien mot de passe est incorrect'
        ]);
      }

    }
}
