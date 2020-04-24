<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Utilisateurs;

class InscriptionController extends Controller
{
    public function formulaire()
    {
      return view('addutilisateur');
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

    public function traitement()
    {
      request()-> validate([
        'name' => ['required'],
        'email' => ['required', 'email'],
        'password'=> ['required', 'confirmed', 'min:8'],
        'password_confirmation'=> ['required'],
      ],[
        'password.min' => 'Pour des raisons de sécurité votre mot de passe doit faire 8 caractères'
      ]); //message spécifique pour le formulaire la

      if ($this->if_exist('name')) {
        return back()->withInput()-> withErrors([
          'name' => 'Ce nom existe déjà!'
        ]);
      }else{
        if ($this->if_exist('email')) {
          return back()->withInput()-> withErrors([
            'email' => 'Cette adresse mail existe déjà!'
          ]);
        }
      }

      $Userst = Utilisateurs::create(
        [
          'name' => request('name'),
          'email' => request('email'),
          'password' => bcrypt(request('password'))
        ]
      );
      flash('Compte crée avec succès!')->success();
      return redirect('/utilisateurs');
    }
}
