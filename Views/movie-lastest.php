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
      <iframe style"display: none" width="560" height="315" src="https://www.youtube.com/embed/<?= json_decode(file_get_contents(API_URL .'/movie/'. $result->getApi_id() .'/videos?'. API_KEY),
      true)['results']['0']['key']?>" 
      frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
      </iframe>
      <?php foreach($result->getGenres() as $genre){
          echo $genreList->getOne($genre) . '<br>';
      } ?></p>
      <a href="#" class="btn btn-primary">Añadir pelicula</a>
      </div>
  </div>
  </div>
    <!-- Grid row -->
    <div class="row">

<!-- Grid column -->
<div class="col-lg-4 col-md-12 mb-4">

  <!--Modal: Name-->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

      <!--Content-->
      <div class="modal-content">

        <!--Body-->
        <div class="modal-body mb-0 p-0">

          <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= json_decode(file_get_contents(API_URL .'/movie/'. $result->getApi_id() .'/videos?'. API_KEY),
      true)['results']['0']['key']?>"
              allowfullscreen></iframe>
          </div>

        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
          <span class="mr-4">Spread the word!</span>
          <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
          <!--Twitter-->
          <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
          <!--Google +-->
          <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
          <!--Linkedin-->
          <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

          <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

        </div>

      </div>
     </div>
</div>
  
  <?php } ?>
          
      </div>
  </div>