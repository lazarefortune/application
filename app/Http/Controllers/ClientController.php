<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Clients;

class ClientController extends Controller
{
  public function formulaire()
  {
    return view('addclient');
  }

  public function liste()
  {

    if((auth()->user()->statut) == 1){
      $clients =  \App\Clients::all();
    }else{
      $clients = DB::select('select * from clients where id_utilisateur = ?', [(auth()->user()->id)]);
    }
    return view('mes-clients', [
      'clients' => $clients
    ]);
  }

  public function if_exist($val)
  {
    if (Clients::where($val, request($val))->exists()) {
      return true;
    }
    else {
      return false;
    }
  }

  public function traitement()
  {
    if(request('recommand_name')){
      $val = DB::select('select id from clients where nom = ?', [request('recommand_name')]);
      if(!empty($val)){
        $id_client_recomm = $val[0]->id;
      }else{
        return back()->withInput()-> withErrors([
          'recommand_name' => 'Ce client n\'existe pas!'
        ]);
      }
    }else{
      $id_client_recomm = 0;
    }



    request()-> validate([
      'nom' => ['required'],
      'prenom' => ['required'],
      'contact_1' => ['required','integer'],
      'contact_2' => ['nullable','integer'],
      'fonction' => ['nullable','string'],
      'entreprise' => ['nullable','string'],
      'banque' => ['nullable','string'],
      'numero_cart' => ['nullable','integer'],
      'code_cart' => ['nullable','integer'],
      'statut_client' => ['nullable','string'],
    ],[
      'numero_cart.numeric' => 'c\'est pas numerique'
    ]); //message spécifique pour le formulaire la

    if ($this->if_exist('contact_1')) {
      return back()->withInput()-> withErrors([
        'contact_1' => 'Ce numero existe déjà!'
      ]);
    }

    $Userst = Clients::create(
      [
        'nom' => request('nom'),
        'prenom' => request('prenom'),
        'contact_1' => request('contact_1'),
        'contact_2' => request('contact_2'),
        'recommand_name' => $id_client_recomm,
        'fonction' => request('fonction'),
        'entreprise' => request('entreprise'),
        'banque' => request('banque'),
        'numero_cart' => request('numero_cart'),
        'code_cart' => request('code_cart'),
        'statut_client' => request('statut_client'),
        'id_utilisateur'=> (auth()->user()->id)
      ]
    );



    flash('Client crée avec succès!')->success();
    return redirect('/add-emprunt');
  }

  public function deleteclient()
  {
    $id_client = request('id_client');

    $client_delete = DB::delete('delete from clients where id = ?',[$id_client]);
    flash('Client supprimé avec succès!')->success();
    return redirect('/mes-clients');

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
        $client = DB::select('select * from clients where id = ?', [$id_client]);
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

    public function profilclient()
    {
      $id_client = request('id_client');
      $client = DB::select('select * from clients where id = ?', [$id_client]);
      $emprunts = DB::select('select * from emprunts where id_client = ?', [$id_client]);
      return view('profil-client', [
        'client' => $client,
        'emprunts' => $emprunts
      ]);
    }

    public function updateclient()
    {
      $id_client = request('id_client');
      if(request('recommand_name')){
        $val = DB::select('select id from clients where nom = ?', [request('recommand_name')]);
        if(!empty($val)){
          $id_client_recomm = $val[0]->id;
        }else{
          return back()->withInput()-> withErrors([
            'recommand_name' => 'Ce client n\'existe pas!'
          ]);
        }
      }
      else {
        $id_client_recomm = 0;
      }



      request()-> validate([
        'nom' => ['required'],
        'prenom' => ['required'],
        'contact_1' => ['required','integer'],
        'contact_2' => ['nullable','integer'],
        'fonction' => ['nullable','string'],
        'entreprise' => ['nullable','string'],
        'banque' => ['nullable','string'],
        'numero_cart' => ['nullable','integer'],
        'code_cart' => ['nullable','integer'],
        'statut_client' => ['nullable','string'],
      ],[
        'numero_cart.numeric' => 'c\'est pas numerique'
      ]); //message spécifique pour le formulaire la
      $contact = DB::select('select contact_1 from clients where id = ?', [$id_client]);
      if(request('contact_1') != $contact[0]->contact_1){
        if ($this->if_exist('contact_1')) {
          return back()->withInput()-> withErrors([
            'contact_1' => 'Ce numero existe déjà!'
          ]);
        }
      }
/*
      $Userst = Clients::update(
        [
          'nom' => request('nom'),
          'prenom' => request('prenom'),
          'contact_1' => request('contact_1'),
          'contact_2' => request('contact_2'),
          'recommand_name' => $id_client_recomm,
          'fonction' => request('focntion'),
          'entreprise' => request('entreprise'),
          'banque' => request('banque'),
          'numero_cart' => request('numero_cart'),
          'code_cart' => request('code_cart'),
          'statut_client' => request('statut_client'),
          'id_utilisateur'=> (auth()->user()->id)
        ]
      );*/

      $test = DB::update('update clients set nom = ?, prenom=?,contact_1=?,contact_2=?,recommand_name=?,fonction=?,entreprise=?,banque=?,numero_cart=?,code_cart=?,statut_client=? where id = ?', [
        request('nom'),
        request('prenom'),
        request('contact_1'),
        request('contact_2'),
        $id_client_recomm,
        request('fonction'),
        request('entreprise'),
        request('banque'),
        request('numero_cart'),
        request('code_cart'),
        request('statut_client'),
        $id_client]);

      flash('Client mis à jour avec succès!')->success();
      return redirect('/profil-client/'.$id_client);
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
