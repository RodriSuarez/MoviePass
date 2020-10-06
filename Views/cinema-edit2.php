<?php require_once('nav.php'); ?>

<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white"> Editar <?= $cinema->getName()?></h2>
        <form action=" <?php echo FRONT_ROOT.CINEMA_ROOT."/EditOneCinema/". $cinema->getName() ?>" method="GET"  >
          <table class="table text-white bg-oscuro"> 
            
              <tr>
              	   <!--  private $name;
        private $address;
        private $capacity;
        private $priceTicket;!-->
        <input type="hidden" value="<?= $cinema->getName() ?>"name="oldname" size="30" required>

                <th>Nombre</th>
                 <td>
                  <input type="text" value="<?= $cinema->getName() ?>"name="name" size="30" required>
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
                <tr>
                <th>Precio de los Tickets</th>
                <td>
                  <input type="number" name="priceTicket" size="10" value="<?= $cinema->getPriceTicket()?>" required>
                </td>
              </tr>     
              </table>
          <br>
          <div>
            <input type="submit" class="btn btn-danger" value="Modificar" "/>
          </div>
        </form>
      
    </div>
        <!--  AGREGAR COSITAS LINDAS -> !-->
     </section>
</main>

