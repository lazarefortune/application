@extends('layout')

@section('contenulayout')



    <div class="row">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between">
          <a href="{{ url('/') }}" class="btn btn-primary btn-sm"><i class="fas fa-chevron-left"></i></i> </a>
        </div>


      </div>
    </div>
    <hr>
    @include('flash::message')

<?php

$util = DB::select('select count(*) as util from utilisateurs');
$nombre_util = $util[0]->util;





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

        <form class="row"  method="post">
          {{ csrf_field() }}
          <div class="col-md-4">
            Montant placé :
          </div>
          <div class="col-md-4 ">

            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="period">
              <option value="30" selected>Choisir...</option>
              <option value="30">Ce mois-ci</option>
              <option value="60">Le mois dernier</option>
              <option value="1">Depuis hier</option>
              <option value="2">Depuis avant hier</option>
            </select>
          </div>
          <div class="col-md-4 ">
            <button type="submit" class="btn btn-primary">Changer</button>
          </div>

        </form>

        <div class="row">
          <div class="col-auto ml-auto mr-auto text-center">
            <h4> <b>{{ $montant_place }} FCFA</b> </h4>
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
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Les intérêts attendus</div>
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


<!-- Content Row -->

@endsection
