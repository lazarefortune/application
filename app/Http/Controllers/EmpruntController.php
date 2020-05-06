<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Emprunt;

class EmpruntController extends Controller
{

    public function formulaire()
    {
      if(request('id_client')){
        $val = DB::select('select nom, prenom from clients where id = ?', [request('id_client')]);
        if(!empty($val)){
           $nom_complet_client  = $val[0]->nom . ' ' . $val[0]->prenom;
        }else{
          return redirect(url('not-found'));
        }
      }else{
        return redirect(url('add-emprunt'));
      }
      return view('addemprunt2',['nom_complet_client' => $nom_complet_client]);
    }

    public function delete_emprunt()
    {
      $id_emprunt = request('id_emprunt');

      $client_delete = DB::delete('delete from emprunts where id = ?',[$id_emprunt]);
      flash('Emprunt supprimé avec succès!')->success();
      return redirect(url()->previous());

    }

    public function liste()
    {
      if(request('id_client')){
        $client = DB::select('select * from clients where id = ?', [request('id_client')]);
        $emprunts = DB::select('select * from emprunts where id_client = ?', [request('id_client')]);
        $total_motant_du = 0;
        foreach ($emprunts as $emprunt) {
          $montant_du = ($emprunt->montant+(($emprunt->montant * $emprunt->taux_interet)/100));
          $total_motant_du = $total_motant_du + $montant_du;
        }


        return view('liste-emprunts', [
          'client' => $client,
          'emprunts' => $emprunts,
          'total_motant_du' => $total_motant_du
        ]);

      }else {
        return 'inconnu';
      }
    }

    public function traitement()
    {


    //creation de l'emprunt

    request()-> validate([
      'montant' => ['required','integer'],
      'taux_interet' => ['required','integer'],
      'date_echeance' => ['required','date'],
      'statut_emprunt' => ['nullable','string'],
    ]);

    $Userst = Emprunt::create(
      [
        'id_client' => request('id_client'),
        'montant' => request('montant'),
        'taux_interet' => request('taux_interet'),
        'date_emprunt' => new \DateTime('today'),
        'date_echeance' => request('date_echeance'),
        'statut_emprunt' => request('statut_emprunt'),
      ]
    );

    flash('Emprunt crée avec succès! Créé en un autre si vous le souhaiter')->success();
    return redirect(url('liste-des-emprunts').'/'.request('id_client'));

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

    public function montant_place()
    {
      if(request('period')){


      }else{
        $montant_place = DB::table('emprunts')
                    ->join('clients', 'emprunts.id_client', '=', 'clients.id')
                    ->select('montant')
                    ->where('clients.id_utilisateur', '=', (auth()->user()->id))
                    ->where('emprunts.created_at', '>', \Carbon\Carbon::now()->subDays(30))
                    ->sum('montant');

      }
      return view('compte-global',[
        'montant_place' => $montant_place
      ]);
    }

    public function montant_place_traitement()
    {
      if(request('period')){

        $montant_place = DB::table('emprunts')
                    ->join('clients', 'emprunts.id_client', '=', 'clients.id')
                    ->select('montant')
                    ->where('clients.id_utilisateur', '=', (auth()->user()->id))
                    ->where('emprunts.created_at', '>', \Carbon\Carbon::now()->subDays(request('period')))
                    ->sum('montant');
      }else{
        $montant_place = DB::table('emprunts')
                    ->join('clients', 'emprunts.id_client', '=', 'clients.id')
                    ->select('montant')
                    ->where('clients.id_utilisateur', '=', (auth()->user()->id))
                    ->where('emprunts.created_at', '>', \Carbon\Carbon::now()->subDays(30))
                    ->sum('montant');

      }
      return view('compte-global',[
        'montant_place' => $montant_place
      ]);
    }
}
