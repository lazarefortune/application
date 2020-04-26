@extends('layout')

@section('contenulayout')
    @include('flash::message')
    <h2 class="mb-4"> <b>Liste des clients</b> </h2>
    <a href="add-client"  class="btn btn-primary"><i class="fas fa-user-plus"></i> Ajouter un client</a>
    <hr>
    <div class="card mb-4">
        <div class="card-body">
            <table id="example" class="table table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>nom</th>
                    <th>contact_1</th>
                    <th>Recommandé par : </th>
                    <th>Statut</th>
                    @if((auth()->user()->statut) == 1)
                    <th>ajouté par : </th>
                    @endif
                    <th class="actions">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)

                <tr>

                    <td><a href="profil-client/{{ $client->id }}"> {{ $client->nom }} {{ $client->prenom }} </a></td>

                    <td>{{ $client->contact_1 }}</td>
                    <?php
                    $nom_reco = DB::select('select nom from clients where id = ?', [($client->recommand_name)]);
                    ?>
                    <td><?php if(!empty($nom_reco)){ echo $nom_reco[0]->nom; }  ?></td>

                    <?php
                    $nom_cre = DB::select('select name from utilisateurs where id = ?', [($client->id_utilisateur)]);
                    ?>
                    <td>
                      @if(($client->statut_client) == 1)
                        <button type="button"  class="btn btn-primary" name="button"><i class="far fa-thumbs-up"></i></button>
                      @elseif(($client->statut_client) == 2)
                        <button type="button"  class="btn btn-danger" name="button"><i class="far fa-thumbs-down"></i></button>
                      @else
                        <button type="button"  class="btn btn-secondary" name="button"><i class="fas fa-thumbtack"></i></button>
                      @endif
                    </td>
                    @if((auth()->user()->statut) == 1)
                    <td> <?php if(!empty($nom_cre[0]->name)){ echo $nom_cre[0]->name; }  ?> </td>
                    @endif
                    <td>
                        <a href="profil-client/{{ $client->id }}" class="btn btn-icon btn-pill btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                      <!--  <a href="#" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-trash"></i></a> -->
                        <button type="button" class="btn btn-icon btn-pill btn-danger" data-toggle="modal" data-target="#exampleModalCenter{{ $client->id }}"><i class="fa fa-fw fa-trash"></i></button>


                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle{{ $client->id }}" style="color: red;">Vous êtes sur le point de supprimer le client suivant :</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>

                      </div>
                      <div class="modal-body text-center">
                        <h3> <b><?= $client->nom, ' ',$client->prenom ?></b></h3>

                      </div>
                      <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <a href="delete-client/{{ $client->id }}"><button type="button" class="btn btn-danger">Oui supprimer</button></a>

                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>




@endsection
