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
        
        </li>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?= FRONT_ROOT . SHOW_ROOT .'ShowListShowsView' ?>"> Cartelera </a>
      </li>
      <li>
        <?php include_once('login-button.php'); ?>
       </li>

    </ul>
    
  </div>
</nav>