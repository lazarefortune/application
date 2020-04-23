@extends('layoutconnexion')

@section('contenuconnexion')

  <div class="container col-sm-6">


    <form method="post"  class="col-sm-10">
      {{ csrf_field() }}

      <h2> <b>Connexion</b> </h2>

      @if($errors->has('email'))
        <div class="alert alert-danger" role="alert">
          {{ $errors->first('email') }}
        </div>
      @endif

      @include('flash::message')


      <div class="row">
        <div class="form-group col-sm-12">
          <label for="email"> <b>Email</b> </label>
          <input type="email" value="{{ old('email') }}" id="mail" class="form-control " name="email" placeholder="Entrez votre email">

        </div>

        </div>
      <div class="row">
        <div class="form-group col-sm-12">
          <label for="mdp"> <b>Mot de passe</b> </label>
          <input type="password"  id="mdp" class="form-control" name="password" placeholder="Entrez votre mdp">
          @if($errors->has('password'))
            <div class="alert alert-danger" role="alert">
              {{ $errors->first('password') }}
            </div>
          @endif
        </div>
      </div>

      <input type="submit"  class="btn btn-primary btn-block" name="" value="se connecter">
      <div class="col-sm-12">
        Vous n'avez pas de compte ?
        <a href="inscription">Cliquez ici</a>
      </div>
    </form>

  </div>

@endsection
