<?php require_once('nav.php'); ?>

<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white "> Editar </h2>
        <form action=" <?php echo FRONT_ROOT.CINEMA_ROOT."EditOneCinema/". $cinema->getIdCinema(); ?>" method="POST"  >
          <table class="table text-white bg-oscuro"> 
            
              <tr>

                <th>Nombre</th>
                 <td>
                  <input type="text" value="<?= $cinema->getCinemaName() ?>"name="cinema_name" size="30" required>
                </td>
           
             </tr>
             <tr>
                <th>Direccion</th>
            <td>
                  <input type="text" name="address" size="30" value="<?= $cinema->getAddress()?>" required>
                </td>
            </tr>
            <tr>
                <th>Capacidad</th>
                <td>
                  <input type="number" name="capacity" size="20" value="<?= $cinema->getCapacity() ?>"required>
                </td>
                </tr>
                
                  
                <input type ="hidden" name="id_cinema" size="20" value="<?=$cinema->getIdCinema()?>">
                  

              </table>
            <br>
          <div>
            <input type="submit" class="btn" value="Modificar" style="background-color:#DC8E47;color:white;"/>
            <a href="<?= FRONT_ROOT . CINEMA_ROOT . 'ShowListView' ?>"> Volver </a>
          </div>
        </form>
      
    </div>
        <!--  AGREGAR COSITAS LINDAS -> !-->
     </section>
</main>

