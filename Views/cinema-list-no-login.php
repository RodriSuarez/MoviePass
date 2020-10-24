<?php require_once('nav-no-login.php'); ?>
<?php include_once('login-button.php'); ?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               
               <h2 class="mb-4 text-center text-white">Listado de Cines</h2>
               <table class="table text-white bg-oscuro">
                    <thead>
                         <th>Nombre</th>
                         <th>Capacidad</th>
                         <th>Dirección</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cinemaList as $key => $cinema)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $cinema->getCinemaName() ?></td>
                                             <td><?php echo $cinema->getCapacity()?></td>
                                             <td><?php echo $cinema->getAddress() ?></td>

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