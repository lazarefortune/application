@extends('layout')

@if((auth()->user()->statut) == 1)
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



<div class="card">
    <div class="card-header d-flex justify-content-between">
         Clients
         <a href="{{ url('add-utilisateur') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Créer un utilisateur</a>
    </div>
    <div class="card-body" v-cloak>

        <table class="table table-hover table-listing">
          <thead  class="">
            <tr>
              <th scope="col">Nom</th>
              <th scope="col" >Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($utilisateurs as $utilisateur)
            @if($utilisateur->id == (auth()->user()->id))

            @else

            <tr  class="table">
              <td>{{ $utilisateur->name }}</td>

              <td >
                <a type="button"  data-toggle="modal" data-target="#exampleModalCenter{{ $utilisateur->id }}"><i class="fa fa-fw fa-trash"></i></a>
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
