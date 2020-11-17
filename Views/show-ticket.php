<?php require_once('nav.php'); ?>
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
     
                              foreach($cinemaList as $key => $cinema)
                              {

                                   ?>
                                        <tr>
                                             <td><?php echo $cinema->getIdCinema() ?></td>
                                             <td><?php echo $cinema->getCinemaName() ?></td>
                                             <td><?php echo $cinema->getCapacity()?></td>
                                             <td><?php echo $cinema->getAddress() ?></td>
                                             <td> 
                                             <?php    if($cinema->getRooms()){?>

                                                  <table class="table text-white bg-oscuro">
                                                       <thead>
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th>Capacidad</th>
                                                            <th>Editar</th>
                                                            <th>Ver funciones</th>
                                                            <th>Eliminar</th>


                                                       </thead>
                                             <?php  
                                                            
                                                            foreach($cinema->getRooms() as $room): ?>
                                                            <tr>
                                                            <td><?= $room->getRoomName()?></td>
                                                            <td><?= $room->getPrice()?></td>
                                                            <td><?= $room->getRoomCapacity()?></td>
                                                            <td> 
                                                                 <form action="<?=FRONT_ROOT. ROOM_ROOT?>ShowEditView/<?= $room->getIdRoom(); ?>" method="POST">

                                    
                                                                 <!-- OJO este input es importante -->

                                                                 <input type="hidden" value="<?=$room->getIdRoom(); //ACA VA GETID?>" name="id_room">

                                                                 <!-- OJO este input es importante -->


                                                                 <button type="submit" class="btn btn-danger">
                                                                      <span uk-icon="icon: trash">+</span>
                                                                 </button>
                                                                 </form>
                                                                 </td>
                                                            <td>
                                                             <form action ="<?= FRONT_ROOT.ROOM_ROOT ?>ShowListShowsView/<?=$room->getIdRoom();?>" method="GET" >
                                                                   <input type="hidden" value = "<?= $room->getIdRoom();?>" name = "id_room">
                                                               <button type="submit" class="btn btn-danger">
                                                                      <span uk-icon="icon: trash">+</span>
                                                                 </button>
                                                                 </form>
                                                            </td>
                                                            <td>
                                                                 <from action ="<?= FRONT_ROOT.ROOM_ROOT ?>DeleteOne/<?=$room->getIdRoom();?>" method ="POST">
                                                       <input type="hidden" value="<?=$room->getIdRoom(); //ACA VA GETID?>" name="id_room">

                                                  <!-- OJO este input es importante -->


                                                 <button type="button" class="btn btn-danger" id="button<?=$room->getIdroom();?>" data-toggle="modal" data-target="#exampleModal<?=$room->getIdroom();?>">
                                                            x
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal<?=$room->getIdroom();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                 <div class="modal-header">
                                                                 <h5 class="modal-title text-dark" id="exampleModalLabel<?=$room->getIdroom();?>">¡Alerta!</h5>
                                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                 </button>
                                                                 </div>
                                                                 <div class="modal-body text-dark">
                                                                      ¿Esta seguro que desea eliminar <?= $room->getroomName() ?> ?<br>
                                                                      <strong>Se eliminaran todas las funciones que se esten dando en esta sala.</strong>
                                                                 </div>
                                                                 <div class="modal-footer">
                                                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                 
                                                                 <form action="<?= FRONT_ROOT . ROOM_ROOT?>DeleteOne\ <?=$room->getIdRoom(); ?>" method="POST">

                                                                      <input type="hidden" value="<?=$room->getIdRoom(); //ACA VA GETID?>" name="delete">

                                                                      <button type="submit" class="btn btn-danger">
                                                                      <span uk-icon="icon: trash">Eliminar</span>
                                                                      </button>
                                                                  </form>
                                                                 </td>
                                                            </tr>

                                                            
                                                            <?php endforeach;?>
                                                  </table>
                                                            <?php 
                                                            }else{
                                                                 echo "No hay salas disponibles";
                                                            }    ?>
                              
                                             
                                        </td>

                                             <td>
                                             <form action="<?=FRONT_ROOT. CINEMA_ROOT?>ShowEditView/<?= $cinema-> getIdCinema(); ?>" method="POST">

                                    
                                                  <!-- OJO este input es importante -->

                                                  <input type="hidden" value="<?=$cinema-> getIdCinema(); //ACA VA GETID?>" name="id_cinema">

                                                  <!-- OJO este input es importante -->


                                                  <button type="submit" class="btn btn-danger">
                                                       <span uk-icon="icon: trash">+</span>
                                                  </button>
                                                  </form>
                                             </td> 

                                             <td>
                                                  <form action ="<?=FRONT_ROOT . ROOM_ROOT ?>ShowAddViewRoom/<?= $cinema->getIdCinema();?> ?>" method="POST">

                                                       <input type="hidden" value=" <?= $cinema->getIdCinema();?>"
                                                       name ="cinema">

                                                  <button type="submit" class="btn btn-danger">
                                                       <span uk-icon="icon: trash">+</span>
                                                       </button>
                                                       </form>   
                                             </td>

                                              <td>
                                             <form action="<?= FRONT_ROOT . CINEMA_ROOT?>DeleteOne\<?= $cinema->getIdCinema();  ?>" method="POST">

                                    
                                                  <!-- OJO este input es importante -->

                                                  <input type="hidden" value="<?= $cinema->getIdCinema(); //ACA VA GETID?>" name="delete">

                                                  <!-- OJO este input es importante -->


                                                       <button type="button" class="btn btn-danger" id="button<?=$cinema->getIdCinema();?>" data-toggle="modal" data-target="#exampleModal<?=$cinema->getIdCinema();?>">
                                                            x
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal<?=$cinema->getIdCinema();?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                 <div class="modal-header">
                                                                 <h5 class="modal-title text-dark" id="exampleModalLabel<?=$cinema->getIdCinema();?>">¡Alerta!</h5>
                                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                 </button>
                                                                 </div>
                                                                 <div class="modal-body text-dark text-center">
                                                                      ¿Esta seguro que desea eliminar <?= $cinema->getCinemaName() ?> ?<br>
                                                                      <strong>Se eliminaran todas las salas que se esten dando en esta cine y sus funciones correspondientes.</strong>
                                                                 </div>
                                                                 <div class="modal-footer">
                                                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                 
                                                                 <form action="<?= FRONT_ROOT . CINEMA_ROOT?>DeleteOne\ <?=$cinema->getIdCinema(); ?>" method="POST">

                                                                      <input type="hidden" value="<?=$cinema->getIdCinema(); //ACA VA GETID?>" name="delete">

                                                                      <button type="submit" class="btn btn-danger">
                                                                      <span uk-icon="icon: trash">Eliminar</span>
                                                                      </button>
                                                                  </form>
                                                                 
                                                                 </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            
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
          </div>
     </section>
</main>