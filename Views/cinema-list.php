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
                                             <form action="<?=FRONT_ROOT. CINEMA_ROOT?>ShowEditView\<?=  $cinema->getId() ?>" method="POST">

                                    
                                                  <!-- OJO este input es importante -->

                                                  <input type="hidden" value="<?=$cinema->getId() //ACA VA GETID?>" name="id">

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


                                                       <button type="button" class="btn btn-danger" id="button<?= $key?>" data-toggle="modal" data-target="#exampleModal<?=$key?>">
                                                            x
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal<?=$key?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                 <div class="modal-header">
                                                                 <h5 class="modal-title text-dark" id="exampleModalLabel<?=$key?>">¡Alerta!</h5>
                                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                 </button>
                                                                 </div>
                                                                 <div class="modal-body text-dark">
                                                                      ¿Esta seguro que desea eliminar <?= $cinema->getName() ?> ?
                                                                 </div>
                                                                 <div class="modal-footer">
                                                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                 
                                                                 <form action="<?= FRONT_ROOT . CINEMA_ROOT?>DeleteOne\<?= ($key)  ?>" method="POST">

                                                                      <input type="hidden" value="<?= ($key) //ACA VA GETID?>" name="delete">

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
     </section>
</main>