<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-left">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Bienvenid@</a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link nav-link-id" href="<?php echo RUTA; ?>">Inicio</a>
        </li>
        <!-- Search -->
        <div id="nav-item-search">
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                Buscador
            </a>
            <div class="dropdown-menu">
                <form style="width: 100%;" class="form-inline" action="/action_page.php">
                <input style="width: 100%;" class="form-control dropdown-item" type="search" placeholder="¿Que desea buscar?">
                </form>
            </div>
            </li>
        </div>
        </ul>
    </div>
</nav>
