@extends('layout')

@if((auth()->user()->statut) == 1)
@section('contenulayout')
    @include('flash::message')
    <h2 class="mb-4"> <b>Liste des utilisateurs</b> </h2>

    <a href="add-utilisateur"  class="btn btn-primary"><i class="fas fa-user-plus"></i> Ajouter un utilisateur</a>
    <hr>
    <div class="card mb-4">
        <div class="card-body">
            <table id="example" class="table table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th class="actions">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($utilisateurs as $utilisateur)
                @if($utilisateur->id == (auth()->user()->id))

                @else
                <tr>
                    <td>{{ $utilisateur->name }}</td>
                    <td>{{ $utilisateur->email }}</td>
                    <td>
                        <button type="button" class="btn btn-icon btn-pill btn-danger" data-toggle="modal" data-target="#exampleModalCenter{{ $utilisateur->id }}"><i class="fa fa-fw fa-trash"></i></button>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{ $utilisateur->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle{{ $utilisateur->id }}" style="color: red;">Vous êtes sur le point de supprimer l'utilisateur suivant :</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>

                      </div>
                      <div class="modal-body text-center">
                        <h3> <b>{{ $utilisateur->name }}</b></h3>

                      </div>
                      <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <a href="delete-utilisateur/{{ $utilisateur->id }}"><button type="button" class="btn btn-danger">Oui supprimer</button></a>

                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@else
@section('contenulayout')
<div class="container">
  <div class="alert alert-danger" role="alert">
    Oups! Vous n'avez pas accès à cette page...
  </div>
</div>
@endsection
@endif
