<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function index()
    {
      if (auth()->guest()) {
        return redirect('/connexion');
      }

      return view('mon-compte');
    }

    public function deconnexion()
    {
      auth()->logout();
      flash("Deconnexion avec succès")->success();
      return redirect('/connexion');
    }

    public function modificationpassword()
    {
      /*
      if (auth()->guest()) {
        flash("Vous devez vous connecté pour voir cette page")->error();

        return redirect('/connexion');
      }*/

      request()->validate([
        'password'=> ['required','confirmed', 'min:8'],
        'password_confirmation' => ['required']
      ]);
      /*
      $utilisateur = auth()->user();
      $utilisateur->password = bcrypt(request('password'));
      $utilisateur->save();
      */
      //au lieu de faire les trois lignes du dessus on peut faire :
      auth()->user()->update([
        'password' => bcrypt(request('password'))
      ]);

      flash('Votre mot de pass a été mis à jour avec succès')->success();
      return redirect('/moncompte');
    }
}
