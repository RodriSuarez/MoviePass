<?php require_once('nav.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Cines</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Capacidad</th>
                         <th>Dirección</th>
                         <th>Precio</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cinemaList as $cinema)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $cinema->getName() ?></td>
                                             <td><?php echo $cinema->getCapacity()?></td>
                                             <td><?php echo $cinema->getAddress() ?></td>
                                             <td><?php echo '$'.$cinema->getPriceTicket() ?></td>
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