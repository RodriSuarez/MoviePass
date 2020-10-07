<div class="container-fluid text-center justify-content align-middle">
  
  <div class="row mt-3 mb-3">
      <?php foreach($movieList as $result) {?>
          <div class="col">
      <div class="card" style="width: 22rem;">
  <img src="<?= API_IMG . $result->getPoster_path();?>" class="card-img-top" alt="Imagen no disponible">
  <div class="card-body">
      <h3 class="card-title"><?= $result->getTitle(); ?></h3>
      <p class="card-text"><?= $result->getOverview(); ?></p>
      <p class="card-text">
      <?php foreach($result->getGenres() as $genre){
          echo $genreList->getOne($genre) . '<br>';
      } ?></p>
      <a href="#" class="btn btn-primary">Añadir pelicula</a>
      </div>
  </div>
  </div>
  <?php } ?>
          
      </div>
  </div>