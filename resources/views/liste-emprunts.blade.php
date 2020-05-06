@extends('layout')

@section('contenulayout')

<style type="text/css">
    input {
      border: 1px solid transparent;
      background-color: #f1f1f1;
      padding: 10px;
      font-size: 16px;
    }
    input[type=text] {
      background-color: #f1f1f1;
      width: 100%;
    }
		.autocomplete {
		  /*the container must be positioned relative:*/
		  position: relative;
		  display: inline-block;
		}

		.autocomplete-items {
		  position: absolute;
		  border: 1px solid #d4d4d4;
		  border-bottom: none;
		  border-top: none;
		  z-index: 99;
		  /*position the autocomplete items to be the same width as the container:*/
		  top: 100%;
		  left: 0;
		  right: 0;
		}
		.autocomplete-items div {
		  padding: 10px;
		  cursor: pointer;
		  background-color: #fff;
		  border-bottom: 1px solid #d4d4d4;
		}
		.autocomplete-items div:hover {
		  /*when hovering an item:*/
		  background-color: #e9e9e9;
		}
		.autocomplete-active {
		  /*when navigating through the items using the arrow keys:*/
		  background-color: DodgerBlue !important;
		  color: #ffffff;
		}
	</style>


  <div class="row">
    <div class="col-sm-12">
      <div class="d-flex justify-content-between">
        <a href="{{ url('mes-clients') }}" class="btn btn-primary btn-sm"><i class="fas fa-chevron-left"></i></i> </a>
      </div>

    </div>
  </div>
<hr>
@include('flash::message')

<div class="row">
<div class="col-sm-12">
  <h4 class="mb-3">Liste des emprunts fait à : <br> <b>{{ $client[0]->nom .' '. $client[0]->prenom }}</b> </h4>

  Le client me doit un total de : <b>{{ $total_motant_du }} Fcfa</b>




  <hr class="mb-4">

</div>
</div>


                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <b>Les emprunts</b>
                        <a href="../add-emprunt/{{ $client[0]->id }}" class="btn btn-primary btn-sm "><i class="fas fa-plus-circle"></i> Ajouter</a>
                    </div>
                    <div class="card-body" v-cloak>




                        <table class="table table-striped">
                          <thead>
                            <tr>

                              <th scope="col">Montant</th>

                              <th scope="col">Montant dû</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $total = 0; ?>
                            @foreach($emprunts as $emprunt)
                            <tr>

                              <td>{{ $emprunt->montant }}</td>

                              <?php
                              $total = $emprunt->montant + $total;
                               $montant_du = ($emprunt->montant+(($emprunt->montant * $emprunt->taux_interet)/100)) ?>
                              <td> <?= $montant_du ?> </td>
                              <td>

                                <a type="button"  data-toggle="modal" data-target="#exampleModalCenter{{ $emprunt->id }}"><i class="fa fa-fw fa-trash"></i></a>
                              </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{ $emprunt->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle{{ $emprunt->id }}" style="color: red;">Vous êtes sur le point de supprimer l'emprunt suivant :</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>

                                  </div>
                                  <div class="modal-body text-center">
                                    <p> Emprunt fait le : <b>{{ $emprunt->date_emprunt }}</b></p>
                                    <p>D'un montant de : <b>{{ $emprunt->montant }} Fcfa</b> </p>
                                    <p>Le montant à perçevoir est : <b><?= $montant_du ?> Fcfa</b> </p>
                                    <p>Date de remboursement prévu pour : <b>{{ $emprunt->date_echeance }}</b></p>

                                  </div>
                                  <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a href="../delete-emprunt/{{ $emprunt->id }}"><button type="button" class="btn btn-danger">Oui supprimer</button></a>

                                  </div>
                                </div>
                              </div>
                            </div>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>Total: {{ $total }}</th>
                              <th>Total: {{ $total_motant_du }}</th>

                            </tr>
                          </tfoot>
                        </table>



                    </div>
               </div>




@endsection
