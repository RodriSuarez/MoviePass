<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
        
        </li><li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT.USER_ROOT.'ShowListView' ?>">Ver Cines</a>

        </li></li>
        <li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT . MOVIE_ROOT .'ShowListMoviesView' ?>"> Ver Peliculas </a>
      </li>
      <li class="nav-item bg-danger rounded">
        <a class="nav-link" href="<?= FRONT_ROOT . USER_ROOT .'ShowRegisterView' ?>">¡Registrate!</a>
      </li>
      
    
  
     
    </ul>
    
  </div>
</nav>