@extends('layout')

@section('contenulayout')



    <div class="container col-sm-8">

      <h2 class="mb-4"> <b>Compte utilisateur</b> </h2>
      @include('flash::message')
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold" style="border: 2px solid green;">
            <h3 style=""> <b>Informations de connexion</b> </h3>

        </div>
        <div class="card-body">
            <form method="post" action="update_profil">
              {{ csrf_field() }}
              <div class="row">
                <div class="form-group col-sm-6">
                    <label for="identifiant"> <b><i class="fas fa-user-shield"></i> Identifiant</b> </label>
                    <input type="text" class="form-control" id="identifiant" aria-describedby="nameHelp" placeholder="Entrez un Identifiant" value="{{ auth()->user()->name }}" name="name">
                    <small id="nameHelp" class="form-text text-muted">Cet identifiant permet la connexion.</small>
                    @if($errors->has('name'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('name') }}
                      </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label for="email"> <b><i class="fas fa-envelope"></i> Email </b></label>
                    <input type="email" class="form-control" id="email" placeholder="Entrez votre adresse mail" value="{{ auth()->user()->email }}" name="email">
                    @if($errors->has('email'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('email') }}
                      </div>
                    @endif
                </div>

              </div>
              <button type="submit" class="btn btn-success" name="button">
                Mettre à jour les informations
              </button>

            </form>
        </div>
    </div>
    <!-- MODIFICATION DU MOT DE PASSE -->
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold" style="border: 2px solid red;">
            <h3> <b>Modification du mot de passe</b> </h3>
        </div>
        <div class="card-body">
            <form method="post" action="modification-password">
              {{ csrf_field() }}

              <div class="row">
                <div class="form-group col-sm-6">
                    <label for="oldpassword"> <b><i class="fas fa-unlock"></i> Ancien mot de passe</b> </label>

                    <input type="password" class="form-control" id="oldpassword" placeholder="Entrez votre mot de passe actuel" name="password_old">
                    @if($errors->has('password_old'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('password_old') }}
                      </div>
                    @endif

                </div>
                <div class="form-group col-sm-6">
                    <label for="passwordnew"> <b><i class="fas fa-unlock"></i> Nouveau mot de passe</b> </label>
                    <input type="password" class="form-control" id="passwordnew" placeholder="Entrez le nouveau mot de passe" name="passwordnew">
                    @if($errors->has('passwordnew'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('passwordnew') }}
                      </div>
                    @endif
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                    <label for="passwordnew_confirm"> <b><i class="fas fa-unlock"></i> Nouveau mot de passe (Confirmation)</b> </label>
                    <input type="password" class="form-control" id="passwordnew_confirm" placeholder="Entrez à nouveau le mot de passe" name="passwordnew_confirmation">
                    @if($errors->has('passwordnew_confirmation'))
                      <div class="alert alert-danger" role="alert">
                        {{ $errors->first('passwordnew_confirmation') }}
                      </div>
                    @endif
                </div>

              </div>
              <button type="submit" class="btn btn-danger" name="button">
                Changer le mot de passe
              </button>

            </form>
        </div>
    </div>

  </div>
@endsection
