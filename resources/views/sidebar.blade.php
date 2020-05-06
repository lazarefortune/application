<ul class="list-unstyled">
    <li  class=" {{ request()->is('/') ? 'active' : '' }} "><a href=""><i class="fas fa-home"></i> Accueil</a></li>
    <li >
        <a href="#sm_base" data-toggle="collapse">
            <i class="fas fa-users"></i> Clients
        </a>
        <ul id="sm_base" class="list-unstyled collapse">
            <li class=" {{ request()->is('add-client') ? 'active' : '' }} "><a href="add-client"><i class="fas fa-user-plus"></i> Ajouter un client</a></li>
            <li><a href="mes-clients"><i class="fas fa-users-cog"></i> Voir les clients</a></li>
        </ul>
    </li>
    <li class=" {{ request()->is('add-emprunt') ? 'active' : '' }} "><a href="add-emprunt"><i class="fa fa-fw fa-book"></i> Ajouter un emprunt</a></li>

    @if((auth()->user()->statut) == 1)
    <li class=" {{ request()->is('utilisateurs') ? 'active' : '' }} "><a href="{{ url('utilisateurs') }}"><i class="fa fa-fw fa-flag"></i> Utilisateurs</a></li>
    @endif

</ul>
