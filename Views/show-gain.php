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
                    <?php foreach($movieList as $movie){
                     ?>
                        <option class="text-center" value="<?= $movie->getId() ?> "> <?= $movie->getTitle()?></option>
                    <?php } ?>
                  </select>
                <button class="btn btn-success rounded "type="submit">Aplicar</button>
            </form>
        </nav>
    </div>
    <?php if(isset($sold)){?>
    <div class="col-10">
        <h2 class="text-white">La cantidad total en pesos vendida en <?=$cinema->getCinemaName() ?> es de $<?=$sold?></h2>
    </div>
    <?php }?>

    <?php if(isset($soldMovie)){?>
    <div class="col-10">
        <h2 class="text-white">La cantidad total en pesos vendida con la pelicula <?=$movie->getTitle() ?> es de $<?=$soldMovie?></h2>
    </div>
    <?php }?>
    </div>

</main>

