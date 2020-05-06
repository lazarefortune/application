@extends('layoutconnexion')

@section('contenuconnexion')


  <form class="form-signin" method="post">
    {{ csrf_field() }}
  <div class="text-center mb-4">

    <h1 class="h3 mb-3 font-weight-normal"> <b>Connexion</b> </h1>

  </div>
  @if($errors->has('email'))
    <div class="alert alert-danger" role="alert">
      {{ $errors->first('email') }}
    </div>
  @endif

  <div class="form-label-group">

    <input  type="email" value="{{ old('email') }}" id="mail" class="form-control " name="email"placeholder="" required>
    <label for="email"> <i class="fas fa-envelope"></i> Email </label>

  </div>

  <div class="form-label-group">

    <input type="password"  id="mdp" class="form-control" name="password" placeholder="" required>
    <label for="mdp"><i class="fas fa-unlock"></i>  Mot de passe </label>
    @if($errors->has('password'))
      <div class="alert alert-danger" role="alert">
        {{ $errors->first('password') }}
      </div>
    @endif
  </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Se souvenir de moi
    </label>
  </div>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>

  <p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2020</p>
</form>

@endsection
