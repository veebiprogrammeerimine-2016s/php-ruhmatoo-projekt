<?php


?>
<!-- ====================
   FORM MODAL  REGISTER
   ======================== -->
<form id="reg" method="POST">
    <div id="register" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Loo kasutaja</h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="regUsername" type="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="regPassword" type="password" class="form-control"
                               aria-describedby="passwordHelpBlock" id="exampleInputPassword1" placeholder="Password">
                        <p id="passwordHelpBlock" class="form-text text-muted">
                            Parool peab olema vahemalt 8 sumboli pikkune
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button id="butt" type="submit" class="btn btn-primary">Registreerun</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>


<!-- ====================
   FORM MODAL  LOGIN
   ======================== -->
<form id="log" method="POST">
    <div id="login" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Logi sisse</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <input name="username" type="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button type="submit" class="btn btn-primary btn-block">Logi sisse</button>
                    <div class="row">
                        <div id="sign-up-form-body">
                            Pole kontot? <a data-toggle="modal" data-target="#register" data-dismiss="modal" style="cursor:pointer">Registreeru!</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<!-- ====================
    MODAL  Booking success message
   ======================== -->
   <div id="bookingMessage" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Broneeringu kinnitus</h4>
                </div>
					
                <div class="modal-body">
					<p>Teie broneering on kinnitatud!</p>
                    <p>Kontrollige oma email</p>
                    
                </div>                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->