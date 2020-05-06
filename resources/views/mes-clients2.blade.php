@extends('layout')

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
                        <div class="card-header">
                             Clients
                        </div>
                        <div class="card-body" v-cloak>

                            <form action="{{ Route('clients.search') }}"  class="miniformsearch">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control mr-1" type="text" name="q" value="{{ request()->q ?? '' }}" placeholder="Rechercher un client..." aria-label="Search">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Search</button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            @if(!empty(request('q')))
                        <!--      <h5 class="mb-4"> <b> {{ $clients->total() }} resultat(s) pour la recherche : "{{ request()->q ?? '' }}"</b> </h5> -->
                              <p class="mb-4"> <b> {{ $clients->total() }} resultat(s) pour la recherche : "{{ request()->q ?? '' }}". </b> <a href="{{ url('mes-clients') }}"> Annuler</a></p>
                            @endif


                            <table class="table table-hover table-listing">
                              <thead  class="">
                                <tr>
                                  <th scope="col">Nom(s) et Prénom(s)</th>

                                  @if((auth()->user()->statut) == 1)
                                <!--  <th scope="col">Recommandé par : </th> -->
                                  @endif
                                  <th scope="col" >Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($clients as $client)

                                <tr  class="table">

                                  <td >
                                    <a href="{{ url('profil-client') }}/<?= $client->id ?>"> {{ $client->nom }} {{ $client->prenom }} </a>
                                  </td>


                                  <?php
                                  $nom_reco = DB::select('select nom from clients where id = ?', [($client->recommand_name)]);
                                  ?>
                            <!--      <td><?php if(!empty($nom_reco)){ echo $nom_reco[0]->nom; }  ?></td> -->

                                  <td >
                                    <a href="{{ url('add-emprunt') }}/{{ $client-> id }}" ><i class="fas fa-plus"></i></a>
                                    <a href="liste-des-emprunts/{{ $client-> id }}"><i class="far fa-eye"></i></a>
                                    <a href="tel:{{ $client->contact_1 }}" > <i class="fas fa-phone-alt"></i></a>
                                    <!--
                                    <a href="{{ url('profil-client') }}/{{ $client->id }}" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                    <a type="button" data-toggle="modal" data-target="#exampleModalCenter{{ $client->id }}"><i style="color: red;" class="fas fa-trash-alt"></i></a>
                                  -->

                                  </td>
                                </tr>

                                @endforeach
                              </tbody>
                            </table>



                        </div>
                   </div>





@endsection
