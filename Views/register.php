<?php 
if(isset($_SESSION['loggedUser'])){ require_once('nav.php'); }
else {require_once('nav-no-login.php'); }
?>
<main class="bg-img-girl">


<div class="container text-white rounded aling-self-center justify-self-center">
    <div class="row py-5 align-items-center">
        <!-- For Demo Purpose -->
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0 text-center">
            <img src="<?php // agregar imagen aca?>" alt="" class="img-fluid mb-3 d-none d-md-block">
          
          
        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form action=" <?php echo FRONT_ROOT.USER_ROOT."Add" ?>" method="POST">
                <div class="row">

                    <!-- First Name -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="firstName" type="text" name="firstname" placeholder="First Name" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Last Name -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="lastName" type="text" name="lastname" placeholder="Last Name" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- DNI -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                            <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                      
                        <input id="dni" type="number" name="dni" placeholder="DNI" class="form-control bg-white border-md border-left-0 pl-3">
                    </div>


              

                    <!-- Password -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="passwordConfirmation" type="password" name="passwordConfirmation" placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type ="submit" class="btn btn-primary btn-block py-2">
                            <span class="font-weight-bold">Registrarse</span>
                        </a>
                    </div>
                    

                 
                </div>

            </form>

             <?php  if(!empty($message) && $success) {?>
  
      <div class="col-4 d-flex align-self-center mt-3 rounded p-3 text-center alert-success" role="alert">
            <?= $message ?>
      </div>    
      <?php }elseif(!empty($message)){ ?>
        <div class="col-4 d-flex align-self-center mt-3 rounded p-3 text-center alert-danger" role="alert">
            <?= $message ?>
      </div>    
      <?php } ?>
        </div>
    </div>
</div>

</main>