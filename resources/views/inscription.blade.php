@extends('layoutconnexion')

@section('contenuconnexion')


  <div class="container col-sm-6">


    <form method="post">
      {{ csrf_field() }}
      <h2> <b>Inscription</b> </h2>




      <div class="row">
        <div class="form-group col-sm-12">
          <label for="name"> <b>Identifiant</b> </label>
          <input type="text" value="{{ old('name') }}" id="name" class="form-control " name="name" placeholder="Choisissez un identifiant">
          @if($errors->has('name'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('name') }}
            </div>
          @endif
        </div>
        <div class="form-group col-sm-12">
          <label for="email"> <b>Email</b> </label>
          <input type="email" value="{{ old('email') }}" id="mail" class="form-control " name="email" placeholder="Entrez votre adresse mail">
          @if($errors->has('email'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('email') }}
            </div>
          @endif
        </div>

        </div>
      <div class="row">
        <div class="form-group col-sm-6">
          <label for="mdp"> <b>Mot de passe</b> </label>
          <input type="password"  id="mdp" class="form-control" name="password" placeholder="Entrez un mot de passe">
          @if($errors->has('password'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('password') }}
            </div>
          @endif
        </div>
        <div class="form-group col-sm-6">
          <label for="mdp2"> <b>Confirmation du mot de passe</b> </label>
          <input type="password"  id="mdp2" class="form-control" name="password_confirmation" placeholder="Saisir à nouveau">
          @if($errors->has('password_confirmation'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('password_confirmation') }}
            </div>
          @endif
        </div>

      </div>

      <input type="submit"  class="btn btn-primary btn-block" name="" value="Créer un compte">

      <div class="col-sm-12">
        Vous avez déjà un compte ?
        <a href="connexion">Cliquez ici</a>
      </div>
    </form>

  </div>


@endsection
