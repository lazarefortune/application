@extends('layout')

@section('contenulayout')
    @include('flash::message')
    <h2 class="mb-4"> <b>Liste des utilisateurs</b> </h2>
    <a href="add-utilisateur"  class="btn btn-primary"><i class="fas fa-user-plus"></i> Ajouter un utilisateur</a>
    <div class="card mb-4">
        <div class="card-body">
            <table id="example" class="table table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th class="actions">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($utilisateurs as $utilisateur)
                <tr>
                    <td>{{ $utilisateur->id }}</td>
                    <td>{{ $utilisateur->name }}</td>
                    <td>{{ $utilisateur->email }}</td>
                    <td>
                        <a href="#" class="btn btn-icon btn-pill btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                        <a href="#" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
