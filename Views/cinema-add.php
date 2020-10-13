<?php require_once('nav.php'); ?>

<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center ">Agregar nuevo cine</h2>
        <form action=" <?php echo FRONT_ROOT.CINEMA_ROOT."/Add" ?>" method="GET"  >
          <table class="table text-white bg-oscuro"> 
            
              <tr>
              	   <!--  private $name;
        private $address;
        private $capacity;
        private $priceTicket;!-->
                <th>Nombre</th>
                 <td>
                  <input type="text" name="name" size="30" required>
                </td>
           
             </tr>
             <tr>
                <th>Direccion</th>
            <td>
                  <input type="text" name="address" size="30" required>
                </td>
            </tr>
            <tr>
                <th>Capacidad</th>
                <td>
                  <input type="number" name="capacity" size="20" required>
                </td>
                </tr>
                <tr>
                <th>Precio de los Tickets</th>
                <td>
                  <input type="number" name="priceTicket" size="10" required>
                </td>
              </tr>     
              </table>
          <br>
          <div>
            <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
          </div>
        </form>

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

  
        <!--  AGREGAR COSITAS LINDAS -> !-->
     </section>
</main>