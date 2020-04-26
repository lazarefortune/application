<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Emprunt;

class EmpruntController extends Controller
{

    public function formulaire()
    {
      return view('addemprunt');
    }

    public function delete_emprunt()
    {
      $id_emprunt = request('id_emprunt');

      $client_delete = DB::delete('delete from emprunts where id = ?',[$id_emprunt]);
      flash('Emprunt supprimé avec succès!')->success();
      return redirect('/mes-clients');

    }

    public function traitement()
    {
      if(request('id_client')){
        $val = DB::select('select id from clients where nom = ?', [request('id_client')]);
        if(!empty($val)){
          $id_client_empr = $val[0]->id;
        }else{
          return back()->withInput()-> withErrors([
            'id_client' => 'Ce client n\'existe pas!'
          ]);
        }
      }else{
        return back()->withInput()-> withErrors([
          'id_client' => 'Veuillez choisir un client'
        ]);
      }



    //creation de l'emprunt

    request()-> validate([
      'montant' => ['required','integer'],
      'taux_interet' => ['required','integer'],
      'date_echeance' => ['required','date'],
      'statut_emprunt' => ['nullable','string'],
    ]);

    $Userst = Emprunt::create(
      [
        'id_client' => $id_client_empr,
        'montant' => request('montant'),
        'taux_interet' => request('taux_interet'),
        'date_emprunt' => new \DateTime('today'),
        'date_echeance' => request('date_echeance'),
        'statut_emprunt' => request('statut_emprunt'),
      ]
    );

    flash('Emprunt crée avec succès! Créé en un autre si vous le souhaiter')->success();
    return redirect('/add-emprunt');

    }

    public function traitement_profil()
    {
      $id_profil = request("id_profil");




    //creation de l'emprunt

    request()-> validate([
      'montant' => ['required','integer'],
      'taux_interet' => ['required','integer'],
      'date_echeance' => ['required','date'],
      'statut_emprunt' => ['nullable','string'],
    ]);

    $Userst = Emprunt::create(
      [
        'id_client' => $id_profil,
        'montant' => request('montant'),
        'taux_interet' => request('taux_interet'),
        'date_emprunt' => new \DateTime('today'),
        'date_echeance' => request('date_echeance'),
        'statut_emprunt' => request('statut_emprunt'),
      ]
    );

    flash('Emprunt crée avec succès! Créé en un autre si vous le souhaiter')->success();
    return redirect('/profil-client/$id_profil');

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
