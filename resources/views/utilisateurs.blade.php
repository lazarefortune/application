@extends('layout')

@section('contenu')


  <div class="container col-sm-6">

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">mail</th>
          <th scope="col">mot_de_passe</th>

        </tr>
      </thead>
      <tbody>
        @foreach($utilisateurs as $utilisateur)
        <tr>
          <th scope="row">{{ $utilisateur->id }}</th>
          <td> {{ $utilisateur->email }} </td>
          <td> non display </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>



@endsection
