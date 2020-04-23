<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Utilisateurs;

class UtilisateursController extends Controller
{
    public function liste()
    {
      $utilisateurs =  \App\Utilisateurs::all();

      return view('utilisateurs', [
        'utilisateurs' => $utilisateurs
      ]);
    }
}
