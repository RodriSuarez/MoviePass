<?php 
require_once('nav.php');

?>
<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white ">Agregar nueva sala</h2>
        <form action="<?php echo FRONT_ROOT.ROOM_ROOT."Add/". $id_cinema; ?>" method="POST"  >
          <table class="table text-white bg-oscuro"> 
              <tr>
   <!--$this->id_room = $id_room;
            $this->room_name = $room_name;
            $this->price = $price; 
            $this->room_capacity = $room_capacity; 
            $this->id_cinema = $id_cinema;
        }-->
                <th>Nombre de la sala</th>
                 <td>
                  <input type="text" name="room_name" size="30" required>
                </td>
           
             </tr>
             <tr>
                <th>Valor del boleto</th>
            <td>
                  <input type="text" min=0 name="price" size="30" required>
                </td>
            </tr>
            <tr>
                <th>Capacidad de la sala</th>
                <td>
                  <input type="number" min=0 name="room_capacity" size="20" required>
                </td>
                </tr>
                <tr>
            
                  <input type="hidden" name="cinema" size="10" value="<?= $id_cinema ?>" >
              
              </tr>     
              </table>
          <br>
          <div>
            <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
            <a href="<?= FRONT_ROOT . CINEMA_ROOT . 'ShowListView' ?>"> Volver </a>
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