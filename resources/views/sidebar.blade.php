<ul class="list-unstyled">
    <li><a href=""><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</a></li>
    <li>
        <a href="#sm_base" data-toggle="collapse">
            <i class="fa fa-fw fa-cube"></i> Compte
        </a>
        <ul id="sm_base" class="list-unstyled collapse">
            <li><a href="">Colors</a></li>
            <li><a href="">Typography</a></li>
        </ul>
    </li>
    @if((auth()->user()->statut) == 1)
    <li><a href="utilisateurs"><i class="fa fa-fw fa-flag"></i> Utilisateurs</a></li>
    @endif
    <li><a href="../"><i class="fa fa-fw fa-book"></i>Accueil</a></li>
</ul>
