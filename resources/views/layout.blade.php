<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>E-clients</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/18119defd2.js" crossorigin="anonymous"></script>

  <!-- Custom styles for this template -->
  <style >
  /*!
  * Start Bootstrap - Simple Sidebar (https://startbootstrap.com/template-overviews/simple-sidebar)
  * Copyright 2013-2019 Start Bootstrap
  * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-simple-sidebar/blob/master/LICENSE)
  */
  body {
  overflow-x: hidden;
  }
  .nav-button
  {
    border: 1px solid black;
    border-radius: 5px;
  }
  #sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
  }

  #sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
  }

  #sidebar-wrapper .list-group {
  width: 15rem;
  }

  #page-content-wrapper {
  min-width: 100vw;
  }

  #wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
  }
  .search{
    display: none;
  }
  .miniformsearch{
    display: none;
  }
  @media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }


  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
  }
  @@media (max-width: 768px) {
    .search{
      display: flex;
    }
    .miniformsearch{
      display: flex;
    }
    .maxform{
      display: none;
    }
  }



  </style>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">


      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">
          <div class="row">
            <div class="col-4 col-sm-6">
              <div class="row mx-auto">
                <?php $nbr_clients = DB::table('clients')->where('id_utilisateur', (auth()->user()->id))->count(); ?>
                <b>{{ $nbr_clients }} </b>
              </div>
              <div class="row mx-auto">
                <b>Client(s)</b>
              </div>
            </div>
            @if(auth()->user()->id == 1)
            <div class="col-4 col-sm-6">
              <div class="row mx-auto">
                <b> {{ App\Utilisateurs::all()->count() }} </b>
              </div>
              <div class="row mx-auto">
                <b>Utilisateurs</b>
              </div>
            </div>
            @endif

          </div>
        </a>
        <a href="{{ url('/profil') }}" class="list-group-item list-group-item-action bg-light " style="color: blue;"><i class="fa fa-user" ></i> Profil</a>
        <a href="{{ url('/mes-clients') }}" class="list-group-item list-group-item-action bg-light " style="color: blue;"><i class="far fa-address-book" ></i> Mes clients</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <!--    <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button> -->

        <button type="button"  class="nav-button" id="menu-toggle"><i class="fa fa-bars"></i></button>

        <a href="{{ url('/') }}" class="ml-2" style="text-decoration: none; color: black;">
          <img src="" alt="" width="80px" height="38px">
        </a>






          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">


            <form action="{{ Route('clients.search') }}" class="form-inline mt-2 mt-md-0 maxform">
              <input class="form-control mr-sm-2" type="text" name="q" value="{{ request()->q ?? '' }}" placeholder="Rechercher un client..." aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>






          </ul>

          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @if(auth()->user()->statut == 1)
            <a class="dropdown-item" href="{{ url('profil') }}">Consulter</a>

            <a class="dropdown-item" href="{{ url('add-utilisateur') }}">Créer un nouveau</a>
            <a class="dropdown-item" href="{{ url('utilisateurs') }}">Voir les utilisateurs</a>
            @endif
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('deconnexion') }}">Déconnexion</a>
          </div>


      </nav>

      <div class="container-fluid">
        <div class="container mt-2 mb-4">

            <div class="row">

             <div class="col-sm-12 col-md-10 col-lg-9 ml-auto mr-auto order-md-1">
                @yield('contenulayout')
             </div>
           </div>

        </div>

      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
