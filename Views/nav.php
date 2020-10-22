<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">MoviePass</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= FRONT_ROOT?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT.CINEMA_ROOT.'ShowAddView'?>">Agregar Cine</a>
        </li><li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT.CINEMA_ROOT.'ShowListView' ?>">Listar Cines</a>

        </li></li>
        <li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT . MOVIE_ROOT .'ShowListMoviesView' ?>">Listar Peliculas</a>
      </li>
      <li class="nav-item bg-danger rounded">
        <a class="nav-link" href="<?= FRONT_ROOT . MOVIE_ROOT .'RefreshLastestMovies' ?>">Actualizar Peliculas</a>
      </li>
      
       <li>
        <?php include_once('login-button.php'); ?>
       </li>
           
     
    </ul>
    <form action="<?=FRONT_ROOT . MOVIE_ROOT .'ShowSearchMoviesView' ?>" class="form-inline my-2 my-lg-0" method="POST">
      <input class="form-control mr-sm-2" type="text" id="busqueda" name="busqueda" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    
  </div>
</nav>