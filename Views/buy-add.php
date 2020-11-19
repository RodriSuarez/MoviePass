<?php 
require_once('nav.php');

 ?>


<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white ">Agregar nueva Compra</h2>
        <form action=" <?php echo FRONT_ROOT. BUY_ROOT."controlBuy" ?>" method="GET"  >
          <table class="table text-white bg-oscuro"> 
            
              <tr>
                <th>Tickets</th>
                 <td>
                  <input type ="hidden" name = "id_show" value = " <?= $show->getId()?>" > 
                  <input type="text" name="QuantTicket" size="30" required>
                </td>
           
             </tr>
             <tr>
                <th>Show</th>
            <td>
                  <input type="text" name="" size="30" placeholder="<?php echo $show->getMovie()->getTitle() ?>"   readonly="readonly" >
         
                </td>
            </tr>
           <tr> 
            <th>Room</th>
            <td>
                  <input type="text" name="" size="30" placeholder="<?php echo $show->getRoom()->getRoomName() ?>"   readonly="readonly" >
                </td>
              </tr>
            <tr> 
              <th>Price</th>
            <td>
                  <input type="text" name="price" size="30" placeholder="<?php echo $show->getRoom()->getPrice(); ?>"  value="<?php echo $show->getRoom()->getPrice(); ?>"  readonly="readonly" >
                </td>
              </tr>
                  <tr> 
              <th>Tarjeta</th>
            <td>
              <select name="creditCard" id="creditCard">
                    <?php foreach($creditList as $credCard):  ?>
                      <option value=" <?= $credCard->getIdCard() ?>" ><?= $credCard->getCompany() . ' terminada en ' . $credCard->getSubNumber() ?></option>
                    <?php endforeach; ?>
              </select>

                </td>
              </tr>
              </table>
              <button class="mt-2 btn btn-success rounded" type="submit">Comprar</button>

          <br>
       
        </form>

        <form action= " <?= FRONT_ROOT . BUY_ROOT . "ShowAddViewCard/"  ?> " method="POST">
     
        <input type ="hidden" name = "id_user" value = " <?=    $_SESSION['loggedUser']['id'] ?>" > 
        <input type ="hidden" name = "id_show" value = " <?= $show->getId()?>" > 

          <button class="mt-2 btn btn-danger rounded" type="submit">Agregar Nueva Tarjeta</button>
        </form>

      <?php  if(!empty($message) && $status) {?>
  
      <div class="col-4 d-flex align-self-center mt-3 rounded p-3 text-center alert-success" role="alert">
            <?= $message ?>
      </div>    
      <?php }elseif(!empty($message)){ ?>
        <div class="col-4 d-flex align-self-center mt-3 rounded p-3 text-center alert-danger" role="alert">
            <?= $message ?>
      </div>    
      <?php }?>
    </div>

  
        <!--  AGREGAR COSITAS LINDAS -> !-->
     </section>
</main>