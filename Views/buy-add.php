<?php require_once('nav.php'); ?>

<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white ">Agregar nueva Compra</h2>
        <form action=" <?php echo FRONT_ROOT.TICKET_ROOT."Add" ?>" method="GET"  >
          <table class="table text-white bg-oscuro"> 
            
              <tr>
                <th>Cant de tickets</th>
                 <td>
                  <input type="text" name="QuantTicket" size="30" required>
                </td>
           
             </tr>
             <tr>
                <th>Show</th>
            <td>
                  <input type="text" name="" size="3-" placeholder="<?php echo $show->getMovie()->getTitle() ?>" readonly="readonly" >
                </td>
            </tr>
           <tr> 
            <th>Room</th>
            <td>
                  <input type="text" name="" size="3-" placeholder="<?php echo $show->getRoom()->getRoomName() ?>" readonly="readonly" >
                </td>
              </tr>
            <tr> 
              <th>Price</th>
            <td>
                  <input type="text" name="" size="3-" placeholder="<?php echo $show->getRoom()->getPrice() ?>"  readonly="readonly" >
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