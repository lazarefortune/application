

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="../"> <b>Business Center</b> </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
          <!--
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li>
          -->
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ auth()->user()->name }} </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="profil" class="dropdown-item"><i class="fas fa-user-edit"></i> Edition du profil</a>
                    <a href="deconnexion" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
