<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content pl-4 pb-5 pr-5">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>Login</h4>
        </div>
        <div class="d-flex flex-column text-center">
          <form action ="<?=FRONT_ROOT.USER_ROOT."login"?>" method="POST">
            <div class="form-group">
              <input type="email" class="form-control" id="email1" name =" email1"placeholder="Your email address...">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="password1" name="pass1" placeholder="Your password...">
            </div>
            <button type="submit" class="btn btn-info btn-block btn-round">Ingresar</button>
          </form>
          
        
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
      <form action ="<?=FRONT_ROOT.USER_ROOT."ShowRegisterView"?>" method="POST">

        <div class="signup-section">¿No sos miembro? <a href="<?=FRONT_ROOT.USER_ROOT."ShowRegisterView"?>" class="text-info">Registrate</a>.</div>
        </form>

      </div>
    </div>
      
  </div>
</div>