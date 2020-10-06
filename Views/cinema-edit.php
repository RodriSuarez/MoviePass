<?php var_dump($cinema) ?>
<div class="d-flex justify-content-center m-5 min-vw-100">
<form class="form" action="EditOneCinema">
  <div class="form-row">
    <div class="col-12">
        <label for="">Nombre del Cine</label>
        <input type="text" class="form-control" placeholder="" value="<?= $cinema->getName() ?>">
      </div>
      </div>
      <div class="form-row">
      <div class="col-12">
      <label for="">Direccion</label>
      <input type="text" class="form-control" placeholder="" value="<?= $cinema->getAddress() ?>">
      </div>
      </div>
 
  <div class="form-row">
  <div class="col-12">
  <label for="">Precio del Ticket</label>
  <input type="numbre" class="form-control" placeholder="" value="<?= $cinema->getPriceTicket() ?>">
  </div>
    </div>
    <div class="form-row">
  <div class="col-12">
  <label for="">Capacidad</label>
  <input type="numbre" class="form-control" placeholder="" value="<?= $cinema->getCapacity() ?>">
  </div>
  </div>  
  <button class="btn btn-primary" type="submit">Submit form</button>
  
</form>

</div>