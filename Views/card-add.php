<?php require_once('nav.php');

 ?>

<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="container">
        
        <h2 class="mb-4 text-center text-white ">Ingrese su tarjeta</h2>
        <form action=" <?php echo FRONT_ROOT.TICKET_ROOT."add" ?>" method="GET"  >
          <table class="table text-white bg-oscuro"> 
            
            
             <tr>
                <th>Numero de tarjeta</th>
            <td>
                  <input type="number" name="card_number" size="30" placeholder="Numero de su tarjeta..">
                </td>
            </tr>

           <tr> 
            <th>Propietario</th>
            <td>
                  <input type="text" name="propietary" size="30" placeholder="Propietario">
                </td>
              </tr>
            <tr> 
            <th>Fecha de expiracion</th>
            <td>
                  <input type="date" name="expiration" size="30" placeholder="Fecha de expiracion"  readonly="readonly" >
                </td>
              </tr>
                  <input type ="hidden" name = "id_user" value = "<?php $user->getIdUser()?>"> 
            </table>
          <br>
          <div>
            <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
          </div>
        </form>
    </div>

      <?php  if(!empty($status) ) {?>
  
      <div class="col-4 d-flex align-self-center mt-3 rounded p-3 text-center alert-success" role="alert">
            <?= $status ?>
      </div>    

    </section>
</main>