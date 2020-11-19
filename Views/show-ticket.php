<?php require_once('nav.php');
var_dump($ticketList); ?>

<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="col-11 justify-content-center">
          <div class="container-fluid">
          <?php 
          if(!empty($message)&& $state){?>
            <div class="row d-flex justify-content-center align-content-center ">
              <p class="text-center  alert-success col-4 p-3"> <?= $message ?></p>
              </div>
          <?php }else if(!empty($message)){?>
            <div class="row d-flex justify-content-center align-content-center ">
              <p class="text-center  alert-danger col-4 p-3"> <?= $message ?></p>
              </div>
      <?php    } ?>
               <h2 class="mb-4 text-center text-white">Compras y Tickets</h2>
               <table class="table text-white bg-oscuro">
                    <thead>
                         <th>#</th>
                         <th>Compra nº</th>
                         <th>Fecha</th>
                         <th>Total</th>
                         <th>Tickets </th>
                         <th>Funcion</th>
                         <th>Sala</th>
                         <th>Cine</th>

                    </thead>
                    <tbody>
                         <?php
     
                              foreach($ticketList as  $ticket)
                              {

                                   ?>
                                        <tr>
                                             <td><?php echo $ticket->getBuy()->getIdBuy() ?></td>
                                             <td><?php echo $ticket->getShow_cinema()->getShowTime() ?></td>
                                             <td><?php echo $ticket->getBuy()->getTotal()?></td>
                                             <td><?php echo $ticket->getBuy()->getCant_tickets() ?></td>
                                             <td><?php echo $ticket->getShow_cinema()->getMovie()->getTitle() ?></td>
                                             <td><?php echo $ticket->getShow_cinema()->getRoom()->getRoomName() ?></td>
                                             <td><?php echo $ticket->getBuy()->getRoom()->getCinema()->getCinemaName() ?></td>
                                        
                                             
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
          </div>
     </section>
</main>