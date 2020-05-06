@extends('layout')

@section('contenulayout')





  <div class="row">


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4 ml-auto mr-auto" >
      <a class="btn btn-success btn-block dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Nouveau prêt
      </a>

      <div class="dropdown-menu btn-block" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item " href="mes-clients">Ancien client</a>
        <a class="dropdown-item " href="add-client">Nouveau client</a>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4 ml-auto mr-auto">
      <a href="compte-global"><button type="button" class="btn btn-secondary btn-block" name="button">Compte global</button></a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 ml-auto mr-auto">
      <a href="mes-clients"><button type="button" class="btn btn-primary btn-block" name="button">Mes clients</button></a>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 ml-auto mr-auto">
      <a href="{{ url('mes-clients/mauvais-payeurs') }}"><button type="button" class="btn btn-danger btn-block" name="button">Mauvais payeurs</button></a>
    </div>


  </div>


<hr>



<?php

$util = DB::select('select count(*) as util from utilisateurs');
$nombre_util = $util[0]->util;

$total = DB::table('emprunts')
            ->join('clients', 'emprunts.id_client', '=', 'clients.id')
            ->select('montant')
            ->where('clients.id_utilisateur', '=', (auth()->user()->id))
            ->where('emprunts.created_at', '>', \Carbon\Carbon::now()->subDays(30))
            ->sum('montant');


$total_fr = $total;

$total_du = DB::table('emprunts')
            ->join('clients', 'emprunts.id_client', '=', 'clients.id')
            ->select('montant','taux_interet')
            ->where('clients.id_utilisateur', '=', (auth()->user()->id))
            ->get();

//var_dump($total_du);
$montant_rec = 0;
foreach ($total_du as $total) {
  $montant_rec = $montant_rec + ($total->montant + (($total->montant)*($total->taux_interet)/100)) ;

}
?>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Montant placé sous les 30 jous</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $total_fr  ?> Fcfa</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Les intérêts attendus sous 30 jours</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $montant_rec ?> Fcfa</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>

<hr>
<div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                         <b>Les clients récents</b>
                    </div>
                    <div class="card-body" v-cloak>

                        <form action="{{ Route('clients.search') }}"  class="miniformsearch">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control mr-1" type="text" name="q" value="{{ request()->q ?? '' }}" minlength="2" placeholder="Rechercher un client..." aria-label="Search">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Search</button>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </form>
                        @if(!empty(request('q')))
                    <!--      <h5 class="mb-4"> <b> {{ $clients->total() }} resultat(s) pour la recherche : "{{ request()->q ?? '' }}"</b> </h5> -->
                          <p class="mb-4"> <b> {{ $clients->total() }} resultat(s) pour la recherche : "{{ request()->q ?? '' }}". </b> <a href="{{ url('mes-clients') }}"> Annuler</a></p>
                        @endif


                        <table class="table table-hover table-listing">
                          <thead  class="">
                            <tr>
                              <th scope="col">Nom(s) et Prénom(s)</th>

                              @if((auth()->user()->statut) == 1)
                            <!--  <th scope="col">Recommandé par : </th> -->
                              @endif
                              <th scope="col" >Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($clients as $client)

                            <tr  class="table">

                              <td >
                                <a href="{{ url('profil-client') }}/<?= $client->id ?>"> {{ $client->nom }} {{ $client->prenom }} </a>
                              </td>


                              <?php
                              $nom_reco = DB::select('select nom from clients where id = ?', [($client->recommand_name)]);
                              ?>
                        <!--      <td><?php if(!empty($nom_reco)){ echo $nom_reco[0]->nom; }  ?></td> -->

                              <td >
                                <a href="{{ url('add-emprunt') }}/{{ $client-> id }}" ><i class="fas fa-plus"></i></a>
                                <a href="liste-des-emprunts/{{ $client-> id }}"><i class="far fa-eye"></i></a>
                                <a href="tel:{{ $client->contact_1 }}" > <i class="fas fa-phone-alt"></i></a>
                                <!--
                                <a href="{{ url('profil-client') }}/{{ $client->id }}" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                <a type="button" data-toggle="modal" data-target="#exampleModalCenter{{ $client->id }}"><i style="color: red;" class="fas fa-trash-alt"></i></a>
                              -->

                              </td>
                            </tr>

                            @endforeach
                          </tbody>
                        </table>



                    </div>
               </div>
            </div>
    </div>



<!-- Content Row -->

@endsection
