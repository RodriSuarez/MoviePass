<?php require_once('nav.php'); 
?>


<main>
    <div class="row">
    <div class="text-white mt-5 ml-5 col-6 aling-content-center justify-content-center"> 
    <p>Busqueda por Cine y fecha </p>
        <nav class="navbar navbar-dark bg-dark">
            <form action="<?= FRONT_ROOT . SHOW_ROOT?>ShowRoomGain">
                <label for="">Fecha Inicio:</label>
                <input type="date" name="first" id="first">
                
                <label for="">Fecha Fin:</label>
                <input type="date" name="last" id="last">

                <label for="">Sala: </label>
                <select class="text-center" name="roomId" id="roomId">
                    <?php foreach($cinemaList as $cinemas){
                     ?>
                        <option class="text-center" value="<?= $cinemas->getIdCinema() ?> "> <?= $cinemas->getCinemaName()?></option>
                    <?php } ?>
                  </select>
                <button class="btn btn-success rounded "type="submit">Aplicar</button>
            </form>
        </nav>

    </div>
      <div class="text-white mt-5 ml-5 col-6 aling-content-center justify-content-center"> 
      
        <p>Busqueda por Pelicula y fecha </p>


        <nav class="mt-5 navbar navbar-dark bg-dark">

            <form action="<?= FRONT_ROOT . SHOW_ROOT?>ShowMovieGain">
                <label for="">Fecha Inicio:</label>
                <input type="date" name="first" id="first">
                <label for="">Fecha Fin:</label>

                <input type="date" name="last" id="last">
                <select class="text-center" name="roomId" id="roomId">
                    <?php foreach($movieList as $movies){
                     ?>
                        <option class="text-center" value="<?= $movies->getId() ?> "> <?= $movies->getTitle()?></option>
                    <?php } ?>
                  </select>
                <button class="btn btn-success rounded "type="submit">Aplicar</button>
            </form>
        </nav>

    </div>
    <div class="text-white mt-5 ml-5 col-6 aling-content-center justify-content-center">
    

        <p>Busqueda Remanentes y cantidades vendidas por pelicula</p>


        <nav class="mt-5 navbar navbar-dark bg-dark">
            <form action="<?= FRONT_ROOT . SHOW_ROOT?>ShowMovieCount">
                <select class="text-center" name="roomId" id="roomId">
                    <?php foreach($movieList as $movies){
                     ?>
                        <option class="text-center" value="<?= $movies->getId() ?> "> <?= $movies->getTitle()?></option>
                    <?php } ?>
                  </select>
                <button class="btn btn-success rounded "type="submit">Aplicar</button>
            </form>
        </nav>

        </div>
        <div class="text-white mt-5 ml-5 col-6 aling-content-center justify-content-center">
      

        <p>Busqueda Remanentes y cantidades vendidas por cine</p>

        <nav class=" mt-5 navbar navbar-dark bg-dark">
            <form action="<?= FRONT_ROOT . SHOW_ROOT?>ShowCinemaCount">

                <select class="text-center" name="roomId" id="roomId">
                    <?php foreach($cinemaList as $cinemas){
                     ?>
                        <option class="text-center" value="<?= $cinemas->getIdCinema() ?> "> <?= $cinemas->getCinemaName()?></option>
                    <?php } ?>
                  </select>
                <button class="btn btn-success rounded "type="submit">Aplicar</button>
            </form>
        </nav>  
        </div>             
      <div class="text-white mt-5 ml-5 col-6 aling-content-center justify-content-center">
       <p>Vendidos y Remanentes por turno </p>
         <nav class=" mt-5 navbar navbar-dark bg-dark">
             <form action="<?= FRONT_ROOT . SHOW_ROOT?>ShowTurnCount">
          
                <select class="text-center" name="roomId" id="roomId">
                    <option class="text-center" value="12"> Mañana de 6 a 12</option>
                        <option class="text-center" value="19"> Tarde de 13 a 19</option>
                        <option class="text-center" value="20"> Noche de 19 a 6</option>
                   
                  </select>
                <button class="btn btn-success rounded "type="submit">Aplicar</button>
            </form>
        </nav>
</div>
    </div>
    <?php if(isset($sold)){?>
    <div class="col-10">
        <h2 class="text-white">La cantidad total en pesos vendida en <strong><?=$cinema->getCinemaName() ?></strong> es de $<?=$sold?></h2>
    </div>
    <?php }?>

    <?php if(isset($soldMovie)){?>
    <div class="col-10">
        <h2 class="text-white">La cantidad total en pesos vendida con la pelicula <strong><?=$movie->getTitle() ?></strong> es de $<?=$soldMovie?></h2>
    </div>
    <?php }?>
    </div>

    <?php if(isset($result)){?>
    <div class="col-10">
        <h2 class="text-white">La pelicula <strong><?= $movie->getTitle() ?></strong> vendio <?=$result['sales']?> entradas</h2>
        <h2 class="text-white">Y quedo un remanente de <?=$result['remaing']?> entradas </h2>
    </div>
    <?php }?>
    </div>
    <?php if(isset($resultCinema)){?>
    <div class="col-10">
        <h2 class="text-white">El cine:  <strong><?= $cinema->getCinemaName() ?></strong> vendio <?=$resultCinema['sales']?> entradas</h2>
        <h2 class="text-white">Y quedo un remanente de <?=$resultCinema['remaing']?> entradas </h2>
    </div>
    <?php }?>
    </div>
      <?php if(isset($resultTurn)){?>
    <div class="col-10">
        <h2 class="text-white">En el Turno:  <strong> <?= $resultTurn['turn']?> </strong> vendio <?=$resultTurn['sales']?> cantidad de entradas</h2>
        <h2 class="text-white">Y quedo un remanente de <?=$resultTurn['remaing']?> entradas </h2>
    </div>
    <?php }?>
    </div>

    
</main>

