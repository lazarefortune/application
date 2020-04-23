@extends('layout')

@section('contenu')
  <div class="container">

    <h1> <b>Mon compte</b> </h1>



    <p>Vous êtes connecté <b>{{ auth()->user()->email }}</b> </p>

    <a href="deconnexion"  class="btn btn-danger">Deconnexion</a>
    <hr>
    <form class="row col-sm-6" action="modification-password" method="post">
      {{ csrf_field() }}
      <h3> <b>Modification du mot de passe</b> </h3>


      <div class="row">
        <div class="form-group col-sm-6">
          <label for="mdp"> <b>Nouveau mot de passe</b> </label>
          <input type="password"  id="mdp" class="form-control" name="password" placeholder="Entrez votre mdp">
          @if($errors->has('password'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('password') }}
            </div>
          @endif
        </div>
        <div class="form-group col-sm-6">
          <label for="mdp2"> <b>mot de passe(confirmation)</b> </label>
          <input type="password"  id="mdp2" class="form-control" name="password_confirmation" placeholder="Confirmer mdp">
          @if($errors->has('password_confirmation'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('password_confirmation') }}
            </div>
          @endif
        </div>

      </div>

      <input type="submit"  class="btn btn-danger btn-block" name="" value="Modifier ">

    </form>

  </div>



@endsection
