<?php require_once('nav.php');
$result = $newMovie; 
$key = 0;
?>
<main class="py-5">
<div class="text-center mt-5"  id="appContainer">

        <div class="container">
        
        <h2 class="mb-4 text-center text-white ">Agregar nueva función</h2>
        <form action=" <?php echo FRONT_ROOT. SHOW_ROOT."Add" ?>" method="GET"  >
        <input type="hidden" name="movieId" value="<?= $result->getId() ?>">
        

          <table class="table text-white bg-oscuro"> 
            
              <!--
              <tr>

                <th>Cine</th>
                 <td>
            
                  <select name="date" id="date">
                    <?php foreach($cinemaList as $cinema){?>
                        <option value="<?= ""/*$cinema->getIdCinema() ?>"><?= $cinema->getCinemaName()*/ ?></option>
                    <?php } ?>
                  </select>
                </td>
            </tr>
                        !-->
                <tr>

                <th>Sala</th>
                 <td>
                
                  <select name="roomId" id="roomId">
                    <?php foreach($roomList as $room){?>
                        <option value="<?= $room->getIdRoom() ?>"><?= $room->getRoomName() ?></option>
                    <?php } ?>
                  </select>
                </td>
                        
             </tr>
             <tr>
                <th>Dia</th>
            <td>
                  <input type="date" name="date" size="30" required>
                </td>
            </tr>
            <tr>
                <th>Hora</th>
                <td>
                    <input class="form" type="time" name="hora" id="hora">
                </td>
                </tr>
                <tr>
               <!-- <th>Cantidad de Salas</th>
                <td>
                  <input type="number" name="room" size="10" required>
                </td>-->
              </tr>     
              </table>
          <br>
          <div>
            <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
          </div>
        </form>
        <div class="row d-flex  justify-content-center align-content-center ">
     <section id="listado" class="mb-5">
         <!-- Grid column -->
      <div class="col-lg-12 col-md-12 m-4">  
        <!--Modal: Name-->
          <div class="clickeable bg-oscuro rounded" alt="video" data-toggle="modal" data-target="#modal<?=$key?>">
            <img class="img-fluid rounded  mt-4 shadow-sm z-depth-1" src="<?= API_IMG . $result->getPoster_path();?>" alt="video" data-toggle="modal" data-target="#modal<?=$key?>">
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
            
              <button type="button" class="btn btn-danger btn-rounded btn-md ml-4" data-dismiss="modal">Cerrar</button>

            </div>

          </div>
          <!--/.Content-->

        </div>
      </div>

      <?php  if(!empty($message) && $success) {?>
  
      <div class="col-4 d-flex align-self-center mt-3 rounded p-3 text-center alert-success" role="alert">
            <?= $message ?>
      </div>    
      <?php }elseif(!empty($message)){ ?>
        <div class="col-4 d-flex align-self-center mt-3 rounded p-3 text-center alert-danger" role="alert">
            <?= $message ?>
      </div>    
      <?php } ?>
    </div>
    </div>
    </div>


  
        <!--  AGREGAR COSITAS LINDAS -> !-->
     </section>
</main>