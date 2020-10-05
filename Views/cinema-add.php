<?php require_once('nav.php'); ?>

<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="content">
        	<div id="comments" >
        <h2>ADD NEW CINEMA</h2>
        <form action=" <?php echo FRONT_ROOT."Cinema/Add" ?>" method="GET"  style="background-color: #EAEDED;padding: 2rem !important;">
          <table> 
            
              <tr>
              	   <!--  private $name;
        private $address;
        private $capacity;
        private $priceTicket;!-->
                <th>Name</th>
                 <td>
                  <input type="text" name="name" size="30" required>
                </td>
           
             </tr>
             <tr>
                <th>Address</th>
            <td>
                  <input type="text" name="address" size="20" required>
                </td>
            </tr>
            <tr>
                <th>Capacity</th>
                <td>
                  <input type="number" name="capacity" size="20" required>
                </td>
                </tr>
                <tr>
                <th>Price of the Tickets</th>
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
      </div>
    </div>


        <!--  AGREGAR COSITAS LINDAS -> !-->
     </section>
</main>