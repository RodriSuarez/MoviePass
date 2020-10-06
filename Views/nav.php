<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">MoviePass</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= FRONT_ROOT?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT.CINEMA_ROOT.'ShowAddView'?>">Add Cinema</a>
        </li><li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT.CINEMA_ROOT.'ShowListView' ?>">List Cinema</a>

      </li></li><li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT . CINEMA_ROOT .'ShowSearchView' ?>">Search Movies</a>
      </li>
 
     
    </ul>
    
  
  </div>
</nav>