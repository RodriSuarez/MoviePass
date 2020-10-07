<div class="text-center ">
<div class="row d-flex ">

      <?php foreach($movieList as $key => $result) { ?>
 
          
<!-- Grid column -->
<div class="col-lg-2 col-md-12 m-4">

  <!--Modal: Name-->
  <div class="modal fade" id="modal<?=$key?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
          
          <h3 class="mr-4"><?= $result->getTitle()?></h3>
          
          <div class="row">
         
              <div class="col-12">
                <hr>
              <h5>Fecha de estreno</h5>
              <p><?php $date = new DateTime($result->getRealease_date());
                    echo date_format($date, "d-m-Y");
                ?></p>
                <hr>
                <h5>Descripción</h5>
            <p class="text-center"><?= $result->getOverview() ?></p>
            <hr>
            <h5 class="font-style-bold" > Genero </h5>
           <p><?= $genreList->getOne($result->getGenres()['0'])?></p>
            <?php if(count($result->getGenres()) > 1){?>
              <h6>Subgeneros</h6>
              <?php
              foreach($result->getGenres() as $index => $genre){
                    if($index != 0){?>
                <p><?= $genreList->getOne($genre) ?> </p>
              <?php }
              }
              } ?>
              <hr>
            
          </div>
         </div>
          <form action="">
            <button class="btn btn-success clickeable" type=submit>Agregar pelicula a la cartelera</button>
  
          </form>
          <button type="button" class="btn btn-danger btn-rounded btn-md ml-4" data-dismiss="modal">Cerrar</button>

        </div>

      </div>
      <!--/.Content-->

    </div>
  </div>
  <!--Modal: Name-->

  <img class="img-fluid rounded-lg btn rounded shadow-sm z-depth-1" src="<?= API_IMG . $result->getPoster_path();?>" alt="video"
      data-toggle="modal" data-target="#modal<?=$key?>">

</div>
<!-- Grid column -->
            



  
  <?php } ?>
          
  </div>