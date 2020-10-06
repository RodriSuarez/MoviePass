<?php require_once('nav.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
            
               <h2 class="mb-4 text-center text-white">Listado de Cines</h2>
               <table class="table text-white bg-oscuro">
                    <thead>
                         <th>Nombre</th>
                         <th>Capacidad</th>
                         <th>Dirección</th>
                         <th>Precio</th>
                         <th>Editar</th>
                         <th>Eliminar</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cinemaList as $key => $cinema)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $cinema->getName() ?></td>
                                             <td><?php echo $cinema->getCapacity()?></td>
                                             <td><?php echo $cinema->getAddress() ?></td>
                                             <td><?php echo '$'.$cinema->getPriceTicket() ?></td>
                                             <td>
                                             <form action="ShowEditView\<?= FRONT_ROOT. $cinema->getName() ?>" method="POST">

                                    
                                                  <!-- OJO este input es importante -->

                                                  <input type="hidden" value="<?= FRONT_ROOT .$cinema->getName() //ACA VA GETID?>" name="name">

                                                  <!-- OJO este input es importante -->


                                                  <button type="submit" class="btn btn-danger">
                                                       <span uk-icon="icon: trash">+</span>
                                                  </button>
                                                  </form>
                                             </td>  
                                              <td>
                                             <form action="<?= FRONT_ROOT . CINEMA_ROOT?>DeleteOne\<?= ($key)  ?>" method="POST">

                                    
                                                  <!-- OJO este input es importante -->

                                                  <input type="hidden" value="<?= ($key) //ACA VA GETID?>" name="delete">

                                                  <!-- OJO este input es importante -->


                                                  <button type="submit" class="btn btn-danger">
                                                       <span uk-icon="icon: trash">x</span>
                                                  </button>
                                                  </form>
                                             </td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>