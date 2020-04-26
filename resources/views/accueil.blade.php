@extends('layout')

@section('contenulayout')

<div class="container align-self-center col-sm-6">
  <h1  class="text-center"> <b>Accueil</b> </h1>
  <div class="row">
    <div class=" ml-auto mr-auto">
    <a href="mes-clients"><button type="button" class="btn btn-primary" name="button">Consulter mes clients</button></a>
    <a href="add-emprunt"><button type="button"  class="btn btn-primary" name="button">Ajouter un emprunt</button></a>

    </div>
  </div>

</div>
<hr>
<?php $client = DB::select('select count(*) as nombre from clients');
$nombre_clients = $client[0]->nombre;

$util = DB::select('select count(*) as util from utilisateurs');
$nombre_util = $util[0]->util;

$total = DB::select('select sum(montant) as total from emprunts');
$total_fr = $total[0]->total;

$total_du = DB::select('select montant,taux_interet from emprunts');
//var_dump($total_du);
$montant_rec = 0;
foreach ($total_du as $total) {
  $montant_rec = $montant_rec + ($total->montant + (($total->montant)*($total->taux_interet)/100)) ;

}
?>
<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Montant placé</div>
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
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Montant à recevoir</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $montant_rec ?> Fcfa</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nombre de clients</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> <?= $nombre_clients  ?> </div>
              </div>

            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Utilisateurs</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $nombre_util  ?> </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->

@endsection
