<?php
if(isset($_SESSION['loggedUser'])){ require_once('nav.php'); }
else {require_once('nav-no-login.php'); }

#var_dump($movieList); ?>


  <div class="row col-3 d-flex justify-content-center align-content-center p-5">
    <form action="<?= FRONT_ROOT . MOVIE_ROOT .'ShowByGenre' ?>" method="GET">
      <span>Filtrar por genero</span>
      <select name="genre" id="genre">
        <option value="0" disabled>-- Selecciona una opcion --</option>
      <?php foreach($genreList as $genre):?>

            <option value="<?= $genre->getName() ?>"><?= $genre->getName() ?></option>

      <?php endforeach;  ?>
      </select>
      <button type="submit">Aplicar</button>
    </form>
  </div>

<div class="text-center mt-5"  id="appContainer">
  <div class="row d-flex justify-content-center align-content-center ">

    <?php foreach($movieList as $key => $result) { ?>

      <!-- Grid column -->
      <div class="col-lg-2 col-md-12 m-4">  
        <!--Modal: Name-->
          <div class="clickeable bg-oscuro rounded" alt="video" data-toggle="modal" data-target="#modal<?=$key?>">
            <img class="img-fluid rounded   shadow-sm z-depth-1" src="<?= API_IMG . $result->getPoster_path();?>" alt="video" data-toggle="modal" data-target="#modal<?=$key?>">
            <h5 class="text-white rounded-bottom   pt-2 pb-2 p-1"><?= $result->getTitle()?></h5>
          </div>
      </div>
      <!-- Grid column -->

      <!--Modal: Name-->
      <div class="modal fade slider-ro" id="modal<?=$key?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <!--Content-->
          <div class="modal-content">

            <!--Body-->
            <div class="modal-body mb-0 p-0">

              <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $result->getTrailer_link()?>" allowfullscreen></iframe>
              </div>

            </div>

            <!--Footer-->
              <div class="modal-footer justify-content-center slider-ro">
            <div class="row col-12 text-center">
            </div>
              <h3 class="mr-4 col-12"><?= $result->getTitle()?></h3>
              
              <div class="row d-flex col-12 justify-content-center">
            
                  <div class="col-12">
                    <hr>
                      <h5>Fecha de estreno</h5>
                      <p><?php $date = new DateTime($result->getRealease_date());
                            echo date_format($date, "d-m-Y");
                        ?></p>
                        <hr>
                        <h5>Sinopsis</h5>
                    <p class="text-center"><?= $result->getOverview() ?></p>
                    <hr>
                    <h5 class="font-style-bold col-12 p-0" > Genero </h5>
                    <p><?php  $generos = $result->getGenres();
                                                         

                            if($generos){
                              $genero = array_shift($generos);
                              echo $genero->getName() ?></p>
                    <?php if(is_array($generos) && sizeof($generos) > 0 ){ ?>
                      <h6>Subgeneros</h6>
                      <?php 
                      foreach($generos as $genre){ ?>
                          
                        <p> <?= $genre->getName() ?> </p>
                      <?php }
                         }
                      } ?>
                      <hr>
                      <h5 class="col-12 text-center p-0">Director</h5>
                      <p><?= $result->getDirector() ?></p>
                      <hr>
                      <h5 class="col-12 text-center p-0">Duración</h5>
                      <p><?= $result->getDuration() . " minutos." ?></p>
                      <hr>
                      <h5 class="col-12 text-center p-0">Valoracion</h5>
                      <p><?= $result->getRating() ?></p>
                
                  </div>
              </div>
              <form action="<?= FRONT_ROOT . SHOW_ROOT ?>ShowAddView/<?= $result->getId()?>" method="get" >
                <button class="btn btn-success " type=submit>Agregar pelicula a la cartelera</button>
      
              </form>
              <button type="button" class="btn btn-danger btn-rounded btn-md ml-4" data-dismiss="modal">Cerrar</button>

            </div>

          </div>
          <!--/.Content-->

        </div>
      </div>
      
    <?php } 

    ?> 
            
  </div>
  
</div>
