<?php require_once('nav.php'); 
?>


<main>
    <div class="row">
    <div class="text-white mt-5 ml-5 col-6 aling-content-center justify-content-center"> 
    <p>Busqueda por Cine</p>
        <nav class="navbar navbar-dark bg-dark">
            <form action="<?= FRONT_ROOT . SHOW_ROOT?>ShowRoomGain">
                <label for="">Fecha Inicio:</label>
                <input type="date" name="first" id="first">
                
                <label for="">Fecha Fin:</label>
                <input type="date" name="last" id="last">

                <label for="">Sala: </label>
                <select class="text-center" name="roomId" id="roomId">
                    <?php foreach($cinemaList as $cinema){
                     ?>
                        <option class="text-center" value="<?= $cinema->getIdCinema() ?> "> <?= $cinema->getCinemaName()?></option>
                    <?php } ?>
                  </select>
                <button class="btn btn-success rounded "type="submit">Aplicar</button>
            </form>
        </nav>
        
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

        <nav class=" mt-5 navbar navbar-dark bg-dark">
            <form action="<?= FRONT_ROOT . SHOW_ROOT?>ShowCinemaCount">
          
                <select class="text-center" name="roomId" id="roomId">
                    <?php foreach($cinemaList as $cinema){
                     ?>
                        <option class="text-center" value="<?= $cinema->getIdCinema() ?> "> <?= $cinema->getCinemaName()?></option>
                    <?php } ?>
                  </select>
                <button class="btn btn-success rounded "type="submit">Aplicar</button>
            </form>
        </nav>               


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
        <h2 class="text-white">La pelicula <strong><?= $movie->getTitle() ?></strong> vendio <?=$result['sales']?> cantidad de entradas</h2>
        <h2 class="text-white">Y quedo un remanente de <?=$result['remaing']?> entradas </h2>
    </div>
    <?php }?>
    </div>
    <?php if(isset($resultCinema)){?>
    <div class="col-10">
        <h2 class="text-white">El cine:  <strong><?= $cinema->getCinemaName() ?></strong> vendio <?=$resultCinema['sales']?> cantidad de entradas</h2>
        <h2 class="text-white">Y quedo un remanente de <?=$resultCinema['remaing']?> entradas </h2>
    </div>
    <?php }?>
    </div>

    
</main>

